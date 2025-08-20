<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductNumber;
use App\Models\Shop;
use App\Models\ShopUser;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $post_views = Post::sum('views');
        $product_views = Product::sum('views');
        $products = ProductNumber::all();

        // $userId = Auth::id();
        // // Ambil shop_id dari pivot shop_users
        // $shopIds = ShopUser::where('user_id', $userId)->pluck('shop_id');
        // $stocksQuery = Stock::with(['product', 'productNumber', 'shop'])
        //     ->orderBy('quantity', 'asc');
        // // Jika user punya shop_id, filter
        // if ($shopIds->isNotEmpty()) {
        //     $stocksQuery->whereIn('shop_id', $shopIds);
        // }
        // $stocks = $stocksQuery->paginate(10);



        $query = Stock::with(['product', 'productNumber', 'shop'])
            ->join('product_numbers', 'stocks.product_number_id', '=', 'product_numbers.id')
            ->join('products', 'stocks.product_id', '=', 'products.id')
            ->select('stocks.*')
            ->orderBy('quantity', 'asc');

        // Filter shop_id dari request (jika ada)
        if ($request->filled('shop_id')) {
            $query->where('stocks.shop_id', $request->shop_id);
        }

        // Filter keyword dari request (jika ada)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('products.name', 'like', "%{$keyword}%")
                    ->orWhere('product_numbers.number', 'like', "%{$keyword}%")
                    ->orWhere('product_numbers.model_number', 'like', "%{$keyword}%");
            });
        }

        // Ambil shop dari pivot shop_users
        $userShopIds = Auth::user()->shop()->pluck('shops.id')->toArray();

        if (!empty($userShopIds)) {
            $query->whereIn('stocks.shop_id', $userShopIds);
            $shops = Shop::whereIn('id', $userShopIds)->get();
        } else {
            $shops = Shop::all();
        }

        $stocks = $query->paginate(10)->appends($request->only('shop_id', 'keyword'));


        // return $stock;

        return view('admin.dashboard', compact('products', 'shops', 'stocks', 'post_views', 'product_views'));
    }
}
