<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'dashboard']]);
    }
    public function index(Request $request)
    {
        return $this->search($request);
    }

    public function search(Request $request)
    {
        try {
            // Start with base query
            $query = Product::where('published', 1);

            // Apply search query
            if ($request->has('q') && !empty($request->q)) {
                $searchTerm = $request->q;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('tags', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%");
                });
            }

            // Apply category filter
            if ($request->has('category') && !empty($request->category)) {
                $query->where('category_id', $request->category);
            }

            // Apply price range filter
            if ($request->has('min_price') && $request->has('max_price')) {
                $query->whereBetween('unit_price', [$request->min_price, $request->max_price]);
            } elseif ($request->has('min_price')) {
                $query->where('unit_price', '>=', $request->min_price);
            } elseif ($request->has('max_price')) {
                $query->where('unit_price', '<=', $request->max_price);
            }

            // Apply sorting
            if ($request->has('sort_by')) {
                switch ($request->sort_by) {
                    case 'newest':
                        $query->latest();
                        break;
                    case 'oldest':
                        $query->oldest();
                        break;
                    case 'price_low_to_high':
                        $query->orderBy('unit_price', 'asc');
                        break;
                    case 'price_high_to_low':
                        $query->orderBy('unit_price', 'desc');
                        break;
                    case 'name_a_to_z':
                        $query->orderBy('name', 'asc');
                        break;
                    case 'name_z_to_a':
                        $query->orderBy('name', 'desc');
                        break;
                    default:
                        $query->latest();
                        break;
                }
            } else {
                // Default sorting
                $query->latest();
            }

            // Get paginated results
            $products = $query->where('published', 1)->paginate(12)->appends($request->query());

            // Get categories with published product counts using our model method
            $categories = Category::withPublishedProductCounts();

            return view('frontend.product_listing', compact('products', 'categories'));
        } catch (Exception $e) {
            Log::error('Product search error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while searching for products.');
        }
    }
    public function show($slug)
    {
        try {
            $product = Product::where('slug', $slug)
                ->where('published', 1)
                ->firstOrFail();

            // Get related products (same category)
            $relatedProducts = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('published', 1)
                ->take(4)
                ->get();

            return view('frontend.product_details', compact('product', 'relatedProducts'));
        } catch (Exception $e) {
            Log::error('Product view error: ' . $e->getMessage());
            return redirect()->route('search')->with('error', 'Product not found.');
        }
    }

    public function category($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            
            $products = Product::where('category_id', $category->id)
                ->where('published', 1)
                ->paginate(12);

            return view('frontend.product_listing', compact('products', 'category'));
        } catch (Exception $e) {
            Log::error('Category view error: ' . $e->getMessage());
            return redirect()->route('search')->with('error', 'Category not found.');
        }
    }
}
