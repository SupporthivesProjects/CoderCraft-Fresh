<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CitigateController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\ContactUSController;
use App\Http\Controllers\ProductController as UserProductController;

use Illuminate\Http\Request;

require __DIR__ . '/admin.php';

Route::middleware(['admin.log'])->group(function () {

    Route::post('/currency', [CurrencyController::class, 'changeCurrency'])->name('currency.change');

    Auth::routes(['verify' => true]);

    Route::get('/logout', [LoginController::class, 'logout']);


    // Social Login
    Route::get('/social-login/redirect/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
    Route::get('/social-login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

    // User Authentication
    Route::get('/users/login', [HomeController::class, 'login'])->name('user.login');
    Route::get('/users/registration', [HomeController::class, 'registration'])->name('user.registration');
    Route::post('/users/login/cart', [HomeController::class, 'cart_login'])->name('cart.login.submit');
    Route::get('verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

    // Home Page
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/home/section/featured', [HomeController::class, 'load_featured_section'])->name('home.section.featured');
    Route::post('/home/section/best_selling', [HomeController::class, 'load_best_selling_section'])->name('home.section.best_selling');
    Route::post('/home/section/home_categories', [HomeController::class, 'load_home_categories_section'])->name('home.section.home_categories');
    Route::post('/home/section/best_sellers', [HomeController::class, 'load_best_sellers_section'])->name('home.section.best_sellers');
    Route::post('/category/nav-element-list', [HomeController::class, 'get_category_items'])->name('category.elements');


    // Flash Deals
    Route::get('/flash-deal/{slug}', [HomeController::class, 'flash_deal_details'])->name('flash-deal-details');

    Route::get('/sitemap.xml', function () {
        return base_path('sitemap.xml');
    });


    // Products
    Route::get('/products', [UserProductController::class, 'index'])->name('products');
    Route::get('/search', [UserProductController::class, 'search'])->name('search');
    Route::get('/product/{slug}', [UserProductController::class, 'show'])->name('product');
    Route::get('/category/{slug}', [UserProductController::class, 'category'])->name('category');

    // Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product');
    // Route::get('/products', [UserProductController::class, 'index'])->name('products');
    // Route::get('/search', [HomeController::class, 'search'])->name('products.category');
    // Route::get('/search', [HomeController::class, 'search'])->name('products.subcategory');
    // Route::get('/search', [HomeController::class, 'search'])->name('products.subsubcategory');
    // Route::get('/search', [HomeController::class, 'search'])->name('products.brand');
    // Route::post('/product/variant_price', [HomeController::class, 'variant_price'])->name('products.variant_price');
    // Route::get('/shops/visit/{slug}', [HomeController::class, 'shop'])->name('shop.visit');
    // Route::get('/shops/visit/{slug}/{type}', [HomeController::class, 'filter_shop'])->name('shop.visit.type');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/nav-cart-items', [CartController::class, 'updateNavCart'])->name('cart.nav_cart');
    Route::post('/cart/show-cart-modal', [CartController::class, 'showCartModal'])->name('cart.showCartModal');
    Route::post('/cart/addtocart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/cart/removeFromCart', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
    Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/addToCart1Step', [CartController::class, 'addToCart1Step'])->name('cart.addToCart1Step');


    // Checkout Routes
    Route::middleware(['checkout', 'verified'])->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'get_shipping_info'])->name('checkout.shipping_info');
        Route::any('/checkout/delivery_info', [CheckoutController::class, 'store_shipping_info'])->name('checkout.store_shipping_infostore');
        Route::post('/checkout/payment_select', [CheckoutController::class, 'store_shipping_info'])->name('checkout.payment_select');
    });

    // Checkout & Payment
    Route::get('/checkout/order-confirmed', [CheckoutController::class, 'order_confirmed'])->name('order_confirmed');
    Route::post('/checkout/payment', [CheckoutController::class, 'checkout'])->name('payment.checkout');
    Route::post('/get_pick_ip_points', [HomeController::class, 'get_pick_ip_points'])->name('shipping_info.get_pick_ip_points');
    Route::get('/checkout/payment_select', [CheckoutController::class, 'get_payment_info'])->name('checkout.payment_info');
    Route::post('/checkout/apply_coupon_code', [CheckoutController::class, 'apply_coupon_code'])->name('checkout.apply_coupon_code');
    Route::post('/checkout/remove_coupon_code', [CheckoutController::class, 'remove_coupon_code'])->name('checkout.remove_coupon_code');

    // CITIGATE
    Route::get('/citigate/pay', [CitigateController::class, 'index']);
    Route::post('/citigate/success', [CitigateController::class, 'success']);
    Route::post('/citigate/fail', function (Request $request) {
        return app(CitigateController::class)->fail($request);
    });
    Route::get('/citigate/fail', [CitigateController::class, 'fail']);
    Route::post('/citigate/cancel', [CitigateController::class, 'cancel']);
    Route::post('/citigate/ipn', [CitigateController::class, 'ipn']);

    // Policy Routes
    Route::get('/sellerpolicy', [HomeController::class, 'sellerpolicy'])->name('sellerpolicy');
    Route::get('/returnpolicy', [HomeController::class, 'returnpolicy'])->name('returnpolicy');
    Route::get('/supportpolicy', [HomeController::class, 'supportpolicy'])->name('supportpolicy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
    Route::get('/privacypolicy', [HomeController::class, 'privacypolicy'])->name('privacypolicy');

    // Service Routes
    Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
    Route::get('/seo', [HomeController::class, 'seo'])->name('seo');
    Route::get('/ppc', [HomeController::class, 'ppc'])->name('ppc');
    Route::get('/orm', [HomeController::class, 'orm'])->name('orm');
    Route::get('/social', [HomeController::class, 'social'])->name('social');
    Route::get('/wdd', [HomeController::class, 'wdd'])->name('wdd');
    Route::get('/em', [HomeController::class, 'em'])->name('em');

    // User Dashboard Routes
    Route::middleware(['user', 'verified'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
        Route::post('/customer/update-profile', [HomeController::class, 'customer_update_profile'])->name('customer.profile.update');
        Route::post('/seller/update-profile', [HomeController::class, 'seller_update_profile'])->name('seller.profile.update');

        Route::resource('purchase_history', PurchaseHistoryController::class);
        Route::post('/purchase_history/details', [PurchaseHistoryController::class, 'purchase_history_details'])->name('purchase_history.details');
        Route::get('/purchase_history/destroy/{id}', [PurchaseHistoryController::class, 'destroy'])->name('purchase_history.destroy');
    });



    // About Us
    Route::get('/about-us', [HomeController::class, 'aboutus'])->name('aboutus');

    // Contact Us
    Route::get('/contact-us', [ContactUSController::class, 'contactUS'])->name('contactus');
    Route::post('/contact-us', [ContactUSController::class, 'contactSaveData'])->name('contactus.store');

    // Account & Address Management
    Route::get('/addresses', [HomeController::class, 'addresses'])->name('addresses');
    Route::get('/account', [HomeController::class, 'account'])->name('account');

    // Legal Pages
    Route::get('/terms-conditions', [HomeController::class, 'termsandconditions'])->name('termsandconditions');
    Route::get('/privacy-policy', [HomeController::class, 'privacypolicy'])->name('privacypolicy');

    // Services
    Route::get('/services', [HomeController::class, 'consulting_services'])->name('services');
    Route::get('/ldd', [HomeController::class, 'ldd'])->name('ldd');

    // Track Order
    Route::get('/track-order', [HomeController::class, 'trackOrder'])->name('orders.track');
    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    // Email Verification Routes
    Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'notice'])
        ->name('verification.notice');
    Route::post('/email/verification-notification', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])
        ->name('verification.resend');
});

Route::get('/test-404', function () {
    abort(404);
});

Route::get('/test-500', function () {
    abort(500);
});

Route::get('/test-403', function () {
    abort(403);
});
