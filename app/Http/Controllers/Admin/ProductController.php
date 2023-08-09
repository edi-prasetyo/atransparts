<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\Production;
use App\Models\ProductNumber;
use App\Models\ProductTranslation;
use App\Models\Vehicle;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $productions = Production::all();
        return view('admin.products.create', compact('categories', 'productions'));
    }
    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $product = new Product;
        if (Product::where('slug', $slugRequest)->exists()) {
            $product->slug = $slug;
        } else {
            $product->slug = $slugRequest;
        }
        $product->production_id = $validatedData['production_id'];
        $product->name = $validatedData['name'];
        $product->trending = $request->trending == true ? '1' : '0';
        $product->status = $request->status == true ? '1' : '0';
        $product->save();

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i =  1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move($uploadPath, $filename);
                $finalImanePathName = $uploadPath  . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImanePathName,
                ]);
            }
        }

        return redirect('admin/products/show/' . $product->id)->with('message', 'Product Added Succesfully!');
    }
    function show(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $productTranslate = ProductTranslation::where('product_id', $product_id)->get();

        return view('admin.products.show', compact('product', 'productTranslate'));
    }
    function add_translate(Request $request)
    {
        $product_translate = new ProductTranslation;
        $product_translate->product_id = $request['product_id'];
        $product_translate->name = $request['name'];
        $product_translate->locale = $request['locale'];
        $product_translate->name = $request['name'];
        $product_translate->short_description = $request['short_description'];
        $product_translate->description = $request['description'];
        $product_translate->meta_title = $request['meta_title'];
        $product_translate->meta_keyword = $request['meta_keyword'];
        $product_translate->meta_description = $request['meta_description'];

        $product_translate->save();
        return redirect()->back()->with('message', 'Product Translate Has Added');
    }
    // Parts Number
    function parts(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $parts = ProductNumber::where('product_id', $product_id)->orderBy('id', 'desc')->get();
        $brands = Brand::all();
        $vehicles = Vehicle::all();
        return view('admin.products.parts', compact('product', 'parts', 'brands', 'vehicles'));
    }
    function add_part(Request $request)
    {
        $product_number = new ProductNumber();
        $product_number->product_id = $request['product_id'];
        $product_number->number = $request['number'];
        $product_number->vendor_number = $request['vendor_number'];
        $product_number->model_number = $request['model_number'];
        $product_number->brand = implode(',', $request->brand);
        $product_number->quantity = $request['quantity'];
        $product_number->buy_price = $request['buy_price'];
        $product_number->sell_price = $request['sell_price'];
        $product_number->vehicle = implode(',', $request->vehicle);


        $product_number->save();
        return redirect()->back()->with('message', 'Product Number Has Added');
    }
    // End Part Number
    public function edit(int $product_id)
    {
        $categories = Category::all();
        $productions = Production::all();
        $product = Product::findOrFail($product_id);
        // dd($product);
        return view('admin.products.edit', compact('categories', 'productions', 'product'));
    }
    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();

        $product = Product::findOrFail($product_id);
        $product->production_id = $validatedData['production_id'];
        $product->slug = $validatedData['slug'];
        $product->name = $validatedData['name'];
        $product->trending = $request->trending == true ? '1' : '0';
        $product->status = $request->status == true ? '1' : '0';



        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i =  1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move($uploadPath, $filename);
                $finalImanePathName = $uploadPath  . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImanePathName,
                ]);
            }
        }

        $product->update();
        return redirect('admin/products')->with('message', 'Product Updated Succesfully!');
    }
    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted!');
    }
    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product and Image was Deleted!');
    }
}
