<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function admin_products(Request $request)
    {
        $type = 'In House';
        $col_name = null;
        $query = null;
        $sort_search = null;

        $products = Product::where('added_by', 'admin');

        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
        }

        if ($request->search != null) {
            $products = $products->where('name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $products = $products->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.products.index', compact('products', 'type', 'col_name', 'query', 'sort_search'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->added_by = 'admin';
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->current_stock = $request->current_stock;
        $product->description = $request->description;

        if($request->hasFile('thumbnail_img')) {
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->current_stock = $request->current_stock;
        $product->description = $request->description;

        if($request->hasFile('thumbnail_img')) {
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }

    public function admin_product_edit($id)
    {
        $product = Product::findOrFail($id);
        $tags = json_decode($product->tags);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories', 'tags'));
    }
}
