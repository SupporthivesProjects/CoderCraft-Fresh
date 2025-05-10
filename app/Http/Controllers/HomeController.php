<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Category,
    FlashDeal,
    Brand,
    SubCategory,
    SubSubCategory,
    Product,
    PickupPoint,
    CustomerPackage,
    User,
    Seller,
    Shop,
    Color,
    Order,
    BusinessSetting
};
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\{Auth, Hash, DB, Cookie, Log};
use Exception;
use Laracasts\Flash\Flash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'dashboard']]);
    }

    public function index()
    {
        try {
            return view('frontend.index');
        } catch (Exception $e) {
            Log::error('Index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function login()
    {
        try {
            if (Auth::check()) {
                return redirect()->route('home');
            }
            return view('frontend.user_login');
        } catch (Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Login failed');
        }
    }

    public function registration(Request $request)
    {
        try {
            if (Auth::check()) {
                return redirect()->route('home');
            }

            if ($request->has('referral_code')) {
                Cookie::queue('referral_code', $request->referral_code, 43200);
            }

            return view('frontend.user_registration');
        } catch (Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration failed');
        }
    }

    public function cart_login(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::whereIn('user_type', ['customer', 'seller'])
                ->where('email', $request->email)
                ->first();

            if ($user && Hash::check($request->password, $user->password)) {
                updateCartSetup();
                auth()->login($user, $request->has('remember'));
                DB::commit();
                return redirect()->back();
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Invalid credentials');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Cart login error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Login failed');
        }
    }

    public function dashboard()
    {
        try {
            switch (Auth::user()->user_type) {
                case 'seller':
                    return view('frontend.seller.dashboard');

                case 'customer':
                    $orders = Order::where('user_id', Auth::user()->id)
                        ->orderBy('code', 'desc')
                        ->paginate(15);
                    return view('frontend.customer.dashboard', compact('orders'));
                default:
                    abort(404);
            }
        } catch (Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load dashboard');
        }
    }

    public function listing(Request $request)
    {
        return $this->search($request);
    }

    public function search(Request $request)
    {
        try {
            $query = $request->q;
            $conditions = ['published' => 1];

            // Build search conditions
            $searchConditions = $this->buildSearchConditions($request);
            $conditions = array_merge($conditions, $searchConditions);

            $products = Product::where($conditions);

            // Apply price filters
            if ($request->min_price && $request->max_price) {
                $products->whereBetween('unit_price', [$request->min_price, $request->max_price]);
            }

            // Apply search query
            if ($query) {
                $products->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('tags', 'like', "%{$query}%");
                });
            }

            // Apply sorting
            $products = $this->applySorting($products, $request->sort_by);

            $products = $products->paginate(12)->appends($request->query());

            return view('frontend.product_listing', compact('products'));
        } catch (Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Search failed');
        }
    }

    private function buildSearchConditions(Request $request)
    {
        $conditions = [];

        if ($request->brand) {
            $brand = Brand::where('slug', $request->brand)->first();
            $conditions['brand_id'] = $brand?->id;
        }

        if ($request->category) {
            $category = Category::where('slug', $request->category)->first();
            $conditions['category_id'] = $category?->id;
        }

        return $conditions;
    }

    private function applySorting($query, $sortBy)
    {
        switch ($sortBy) {
            case '1':
                return $query->latest();
            case '2':
                return $query->orderBy('unit_price', 'asc');
            case '3':
                return $query->orderBy('unit_price', 'desc');
            case '4':
                return $query->orderBy('num_of_sale', 'desc');
            default:
                return $query;
        }
    }

    public function variant_price(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $str = '';
            $quantity = 0;

            if ($request->has('color')) {
                $str = Color::where('code', $request->color)->first()->name;
            }

            foreach (json_decode($product->choice_options) as $choice) {
                $str = $str ?
                    $str . '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]) :
                    str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
            }

            $price = $this->calculateProductPrice($product, $str, $quantity);

            return [
                'price' => single_price($price * $request->quantity),
                'quantity' => $quantity
            ];
        } catch (Exception $e) {
            Log::error('Variant price calculation error: ' . $e->getMessage());
            return response()->json(['error' => 'Price calculation failed'], 500);
        }
    }

    public function flash_deal_details($slug)
    {
        try {
            $flash_deal = FlashDeal::where('slug', $slug)->firstOrFail();
            return view('frontend.flash_deal_details', compact('flash_deal'));
        } catch (Exception $e) {
            Log::error('Flash deal error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Flash deal not found');
        }
    }

    public function shop($slug)
    {
        try {
            $shop = Shop::where('slug', $slug)->firstOrFail();
            $seller = Seller::where('user_id', $shop->user_id)->firstOrFail();

            $view = $seller->verification_status ?
                'frontend.seller_shop' :
                'frontend.seller_shop_without_verification';

            return view($view, compact('shop', 'seller'));
        } catch (Exception $e) {
            Log::error('Shop view error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Shop not found');
        }
    }

    public function product(Request $request, $slug)
    {
        try {
            $product = Product::where('slug', $slug)
                ->where('published', 1)
                ->firstOrFail();

            if ($request->has('product_referral_code')) {
                $this->handleProductReferral($request, $product);
            }

            return view('frontend.product_details', compact('product'));
        } catch (Exception $e) {
            Log::error('Product view error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Product not found');
        }
    }

    public function trackOrder(Request $request)
    {
        try {
            if ($request->has('order_code')) {
                $order = Order::where('code', $request->order_code)->first();
                return view('frontend.track_order', compact('order'));
            }
            return view('frontend.track_order');
        } catch (Exception $e) {
            Log::error('Order tracking error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to track order');
        }
    }

    public function customer_update_profile(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Update user using DB query builder
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'country' => $request->country,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'phone' => $request->phone
                ]);

            if ($request->new_password && $request->new_password === $request->confirm_password) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($request->new_password)]);
            }

            if ($request->hasFile('photo')) {
                $avatarPath = $request->photo->store('uploads/users');
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['avatar_original' => $avatarPath]);
            }

            DB::commit();
            Flash::success('Profile updated successfully!');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Profile update error: ' . $e->getMessage());
            Flash::error('Profile update failed. Please try again.');
            return redirect()->back();
        }
    }




    private function calculateProductPrice($product, $variant, &$quantity)
    {
        if ($variant && $product->variant_product) {
            $product_stock = $product->stocks->where('variant', $variant)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;
        } else {
            $price = $product->unit_price;
            $quantity = $product->current_stock;
        }

        // Apply discounts and taxes
        $price = $this->applyDiscounts($product, $price);
        $price = $this->applyTaxes($product, $price);

        return $price;
    }

    private function handleProductReferral(Request $request, Product $product)
    {
        Cookie::queue('product_referral_code', $request->product_referral_code, 43200);
        Cookie::queue('referred_product_id', $product->id, 43200);
    }

    private function shouldUpdatePassword(Request $request): bool
    {
        return $request->new_password &&
            $request->new_password === $request->confirm_password;
    }

    public function ajax_search(Request $request)
    {
        try {
            $keywords = [];
            $products = Product::where('published', 1)
                ->where('tags', 'like', '%' . $request->search . '%')
                ->get();

            foreach ($products as $product) {
                $tags = explode(',', $product->tags);
                foreach ($tags as $tag) {
                    if (stripos($tag, $request->search) !== false) {
                        if (count($keywords) > 5) break;
                        if (!in_array(strtolower($tag), $keywords)) {
                            $keywords[] = strtolower($tag);
                        }
                    }
                }
            }

            $products = Product::where('published', 1)
                ->where('name', 'like', '%' . $request->search . '%')
                ->take(3)
                ->get();

            $subsubcategories = SubSubCategory::where('name', 'like', '%' . $request->search . '%')
                ->take(3)
                ->get();

            $shops = Shop::whereIn('user_id', verified_sellers_id())
                ->where('name', 'like', '%' . $request->search . '%')
                ->take(3)
                ->get();

            if (count($keywords) > 0 || count($subsubcategories) > 0 || count($products) > 0 || count($shops) > 0) {
                return view('frontend.partials.search_content', compact('products', 'subsubcategories', 'keywords', 'shops'));
            }

            return '0';
        } catch (Exception $e) {
            Log::error('Ajax search error: ' . $e->getMessage());
            return response()->json(['error' => 'Search failed'], 500);
        }
    }

    public function load_featured_section()
    {
        try {
            return view('frontend.partials.featured_products_section');
        } catch (Exception $e) {
            Log::error('Featured section load error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load featured section'], 500);
        }
    }

    public function load_best_selling_section()
    {
        try {
            return view('frontend.partials.best_selling_section');
        } catch (Exception $e) {
            Log::error('Best selling section load error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load best selling section'], 500);
        }
    }

    public function seller_product_list(Request $request)
    {
        try {
            $products = Product::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('frontend.seller.products', compact('products'));
        } catch (Exception $e) {
            Log::error('Seller product list error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load products');
        }
    }

    public function show_product_upload_form()
    {
        try {
            $categories = Category::all();
            return view('frontend.seller.product_upload', compact('categories'));
        } catch (Exception $e) {
            Log::error('Product upload form error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load upload form');
        }
    }

    public function seller_update_profile(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Update user data
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'country' => $request->country,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'phone' => $request->phone
                ]);

            if ($request->new_password && $request->new_password === $request->confirm_password) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($request->new_password)]);
            }

            if ($request->hasFile('photo')) {
                $avatarPath = $request->photo->store('uploads');
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['avatar_original' => $avatarPath]);
            }

            // Update seller data
            DB::table('sellers')
                ->where('user_id', $user->id)
                ->update([
                    'cash_on_delivery_status' => $request->cash_on_delivery_status,
                    'bank_payment_status' => $request->bank_payment_status,
                    'bank_name' => $request->bank_name,
                    'bank_acc_name' => $request->bank_acc_name,
                    'bank_acc_no' => $request->bank_acc_no,
                    'bank_routing_no' => $request->bank_routing_no
                ]);

            DB::commit();
            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Seller profile update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Profile update failed');
        }
    }

    public function get_pick_up_points(Request $request)
    {
        try {
            $pick_up_points = PickupPoint::all();
            return view('frontend.partials.pick_up_points', compact('pick_up_points'));
        } catch (Exception $e) {
            Log::error('Pickup points error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load pickup points'], 500);
        }
    }

    public function languages()
    {
        try {
            return view('frontend.languages');
        } catch (Exception $e) {
            Log::error('Languages error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load languages');
        }
    }

    public function documents()
    {
        try {
            return view('frontend.documents');
        } catch (Exception $e) {
            Log::error('Documents error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load documents');
        }
    }


    public function aboutus()
    {
        return view('frontend.about_us');
    }

    public function contactus()
    {
        return view('frontend.contact_us');
    }

    public function addresses()
    {
        return view('frontend.customer.addresses');
    }

    public function account()
    {
        return view('frontend.customer.account');
    }

    public function termsandconditions()
    {
        return view('frontend.termsandconditions');
    }

    public function privacypolicy()
    {
        return view('frontend.privacypolicy');
    }

    public function faqs()
    {
        return view('frontend.faqs');
    }

    public function seo()
    {
        try {
            // Get SEO products (category_id = 1) organized by subscription duration
            $seoProducts = [
                '1_month' => Product::where('category_id', 1)
                    ->where('subscription', '1 Month')
                    ->orderBy('unit_price')
                    ->get(),
                '3_months' => Product::where('category_id', 1)
                    ->where('subscription', '3 Months')
                    ->orderBy('unit_price')
                    ->get(),
                '6_months' => Product::where('category_id', 1)
                    ->where('subscription', '6 Months')
                    ->orderBy('unit_price')
                    ->get(),
                '12_months' => Product::where('category_id', 1)
                    ->where('subscription', '12 Months')
                    ->orderBy('unit_price')
                    ->get(),
            ];

            return view('frontend.seo', compact('seoProducts'));
        } catch (Exception $e) {
            Log::error('SEO page error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function ppc()
    {
        try {
            // Fetch all PPC packages from the database (category_id = 2)
            $ppcProducts = [
                '1_month' => Product::where('category_id', 2)
                    ->where('subscription', '1 Month')
                    ->orderBy('unit_price')
                    ->get(),
                '3_months' => Product::where('category_id', 2)
                    ->where('subscription', '3 Months')
                    ->orderBy('unit_price')
                    ->get(),
                '6_months' => Product::where('category_id', 2)
                    ->where('subscription', '6 Months')
                    ->orderBy('unit_price')
                    ->get(),
                '12_months' => Product::where('category_id', 2)
                    ->where('subscription', '12 Months')
                    ->orderBy('unit_price')
                    ->get(),
            ];

            return view('frontend.ppc', compact('ppcProducts'));
        } catch (Exception $e) {
            Log::error('PPC page error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load PPC packages');
        }
    }

    public function orm()
    {
        try {
            // Fetch all ORM packages from the database (category_id = 3)
            $ormProducts = [
                '1_month' => Product::where('category_id', 3)
                    ->where('subscription', '1 Month')
                    ->orderBy('unit_price')
                    ->get(),
                '3_months' => Product::where('category_id', 3)
                    ->where('subscription', '3 Months')
                    ->orderBy('unit_price')
                    ->get(),
                '6_months' => Product::where('category_id', 3)
                    ->where('subscription', '6 Months')
                    ->orderBy('unit_price')
                    ->get(),
                '12_months' => Product::where('category_id', 3)
                    ->where('subscription', '12 Months')
                    ->orderBy('unit_price')
                    ->get(),
            ];

            return view('frontend.orm', compact('ormProducts'));
        } catch (Exception $e) {
            Log::error('ORM page error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load ORM packages');
        }
    }
public function social()
{
    try {
        // Fetch all Social Media packages from the database (category_id = 4)
        $socialProducts = [
            '1_month' => Product::where('category_id', 4)
                ->where('subscription', '1 Month')
                ->orderBy('unit_price')
                ->get(),
            '3_months' => Product::where('category_id', 4)
                ->where('subscription', '3 Months')
                ->orderBy('unit_price')
                ->get(),
            '6_months' => Product::where('category_id', 4)
                ->where('subscription', '6 Months')
                ->orderBy('unit_price')
                ->get(),
            '12_months' => Product::where('category_id', 4)
                ->where('subscription', '12 Months')
                ->orderBy('unit_price')
                ->get(),
        ];

        return view('frontend.social', compact('socialProducts'));
    } catch (Exception $e) {
        Log::error('Social Media page error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to load Social Media packages');
    }
}
public function wdd()
{
    try {
        // Fetch all Web Design & Development packages from the database (category_id = 5)
        $wddProducts = [
            '1_month' => Product::where('category_id', 5)
                ->where('subscription', '1 Month')
                ->orderBy('unit_price')
                ->get(),
            '3_months' => Product::where('category_id', 5)
                ->where('subscription', '3 Months')
                ->orderBy('unit_price')
                ->get(),
            '6_months' => Product::where('category_id', 5)
                ->where('subscription', '6 Months')
                ->orderBy('unit_price')
                ->get(),
            '12_months' => Product::where('category_id', 5)
                ->where('subscription', '12 Months')
                ->orderBy('unit_price')
                ->get(),
        ];

        return view('frontend.wdd', compact('wddProducts'));
    } catch (Exception $e) {
        Log::error('WDD page error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to load Web Design & Development packages');
            
    }
}
public function em()
{
    try {
        // Fetch all Email Marketing packages from the database (category_id = 6)
        $emProducts = [
            '1_month' => Product::where('category_id', 6)
                ->where('subscription', '1 Month')
                ->orderBy('unit_price')
                ->get(),
            '3_months' => Product::where('category_id', 6)
                ->where('subscription', '3 Months')
                ->orderBy('unit_price')
                ->get(),
            '6_months' => Product::where('category_id', 6)
                ->where('subscription', '6 Months')
                ->orderBy('unit_price')
                ->get(),
            '12_months' => Product::where('category_id', 6)
                ->where('subscription', '12 Months')
                ->orderBy('unit_price')
                ->get(),
        ];

        return view('frontend.em', compact('emProducts'));
    } catch (Exception $e) {
        Log::error('Email Marketing page error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to load Email Marketing packages');
    }
}

}