<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Requests\ProductFormRequest;
use App\Models\ProductImage;
use App\Models\Production;
use App\Models\ProductTranslation;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->paginate(1);
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

        $slugRequest = Str::slug($validatedData['slug']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $product = new Product;
        if (Product::where('slug', $slugRequest)->exists()) {
            $product->slug = $slug;
        } else {
            $product->slug = $slugRequest;
        }
        $product->production_id = $validatedData['production_id'];
        $product->original_price = $validatedData['original_price'];
        $product->selling_price = $validatedData['selling_price'];
        $product->quantity = $validatedData['quantity'];
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

        $product = Category::findOrFail($validatedData['category_id'])
            ->products()->where('id', $product_id)->first();
        if ($product) {
            $product->update([
                'category_id' => $validatedData['production_id'],
                'slug' => $validatedData['slug'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
            ]);

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

            return redirect('admin/products')->with('message', 'Product Updated Succesfully!');
        } else {
            return redirect('admin/products')->with('message', 'No Such Product ID Found ');
        }
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
