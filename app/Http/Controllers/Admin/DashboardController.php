<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $post_views = Post::sum('views');
        $product_views = Product::sum('views');
        $products = Product::all();
        // return $post_views;
        return view('admin.dashboard', compact('products', 'post_views', 'product_views'));
    }
}
