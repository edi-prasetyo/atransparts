<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductNumber;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $locale = app()->currentLocale();

        $products = Product::with(['productTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->paginate(2);

        return view('frontend.product.index', compact('products'));
    }

    public function detail($products_slug)
    {
        $locale = app()->currentLocale();
        $header = Slider::where('status', '1')->where('type', 1)->get();
        $productSidebar = Product::with(['productTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();
        $product = Product::with(['productTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->where('slug', $products_slug)->first();
        $images = $product->productImages;
        // return $images;
        $part_number = ProductNumber::where('product_id', $product->id)->orderBy('id', 'desc')->get();

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $product->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $product->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $product->incrementReadCount(); //count the view
            return response()
                ->view('frontend.product.detail', [
                    'product' => $product,
                    'images' => $images,
                    'header' => $header,
                    'productSidebar' => $productSidebar,
                    'part_number' => $part_number,
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            // return $post;
            return view('frontend.product.detail', compact('product', 'images', 'header', 'productSidebar', 'part_number'));
        }
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->selling_price,
                    "photo" => $product->productImages[0]->image
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->selling_price,
            "photo" => $product->photo
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function cart()
    {
        return view('frontend.cart.cart');
    }
    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function checkout()
    {
        $cart = session()->get('cart');
        return $cart;
    }
}
