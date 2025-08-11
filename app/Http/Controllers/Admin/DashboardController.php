<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductNumber;
use App\Models\ShopUser;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $post_views = Post::sum('views');
        $product_views = Product::sum('views');
        $products = ProductNumber::all();

        $userId = Auth::id();
        // Ambil shop_id dari pivot shop_users
        $shopIds = ShopUser::where('user_id', $userId)->pluck('shop_id');
        $stocksQuery = Stock::with(['product', 'productNumber', 'shop'])
            ->orderBy('quantity', 'asc');
        // Jika user punya shop_id, filter
        if ($shopIds->isNotEmpty()) {
            $stocksQuery->whereIn('shop_id', $shopIds);
        }
        $stocks = $stocksQuery->paginate(10);
        // return $stock;

        return view('admin.dashboard', compact('products', 'stocks', 'post_views', 'product_views'));
    }
}
