<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function admin_dashboard()
    {
        try {
            $total_users = User::count();
            $total_orders = Order::count();
            $total_products = Product::count();
            $total_sellers = Seller::count();
            return view('admin.dashboard', compact(
                'total_users',
                'total_orders',
                'total_products',
                'total_sellers'
            ));
        } catch (Exception $e) {
            Log::error('Admin dashboard error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load admin dashboard');
        }
    }
}
