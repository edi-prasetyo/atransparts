<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $locale = app()->currentLocale();

        $sliders = Slider::where('status', '1')->get();
        $products = Product::with(['productTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();
        $posts = Post::with(['postTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->where('status', 1)->orderBy('id', 'desc')->take(3)->get();
        $categories = Category::with(['categoryTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();
        $sliders = Slider::all();
        // return $posts;
        return view('frontend.index', compact('sliders', 'categories', 'products', 'posts', 'sliders'));
    }
    public function categories()
    {
        $categories = Category::where('status', 1)->get();
        return view('frontend.category.index', compact('categories'));
    }
    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $products =  $category->products()->get();
            return view('frontend.category.products', compact('products', 'category'));
        } else {
            return redirect()->back();
        }
    }
    public function detail($products_slug)
    {
        $header = Slider::where('status', '1')->where('type', 1)->get();
        $product = Product::where('slug', $products_slug)->first();
        $images = $product->productImages;
        // return $images;
        return view('frontend.product.detail', compact('product', 'images', 'header'));
    }

    function contact()
    {
        return view('frontend.about.contact');
    }
}
