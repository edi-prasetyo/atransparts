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
use App\Models\ProductBrand;
use App\Models\ProductImage;
use App\Models\Production;
use App\Models\ProductNumber;
use App\Models\ProductTranslation;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\StockLog;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

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

        return redirect('admin/products/' . $product->id)->with('message', 'Product Added Succesfully!');
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
    public function edit_translate($id)
    {
        $translation = ProductTranslation::findOrFail($id);
        $product = Product::findOrFail($translation->product_id);

        return view('admin.products.edit_translate', compact('translation', 'product'));
    }

    public function update_translate(Request $request, $id)
    {
        $translation = ProductTranslation::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:255',
            'locale'            => 'required|string|max:5',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keyword'      => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
        ]);

        $translation->update([
            'locale'            => $request->locale,
            'name'              => $request->name,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'meta_title'        => $request->meta_title,
            'meta_keyword'      => $request->meta_keyword,
            'meta_description'  => $request->meta_description,
        ]);

        return redirect('admin/products/' . $translation->product_id)
            ->with('message', 'Product Translate Updated Successfully!');
    }
    public function destroy_translate($id)
    {
        $translation = ProductTranslation::findOrFail($id);
        $productId   = $translation->product_id; // simpan product_id biar bisa redirect

        $translation->delete();

        return redirect('admin/products/' . $productId)
            ->with('message', 'Product Translate Deleted Successfully!');
    }
    // Parts Number
    function parts(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $parts = ProductNumber::where('product_id', $product_id)->orderBy('id', 'desc')->get();
        $brands = Brand::all();
        $productBrands = ProductBrand::all();
        $vehicles = Vehicle::all();
        return view('admin.products.parts', compact('product', 'parts', 'brands', 'vehicles', 'productBrands'));
    }
    public function add_part(Request $request)
    {
        $validated = $request->validate([
            'product_id'       => 'required|exists:products,id',
            'number'           => 'required|string|max:255',
            'vendor_number'    => 'nullable|string|max:255',
            'model_number'     => 'nullable|string|max:255',
            'brand'            => 'required|array',
            'brand.*'          => 'string|max:255',
            'product_brand_id' => 'required',
            'buy_price'        => 'required|numeric|min:0',
            'sell_price'       => 'required|numeric|min:0',
            'vehicle'          => 'required|array',
            'vehicle.*'        => 'string|max:255',
            'initial_quantity' => 'nullable|integer|min:0', // optional stok awal
        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan ke product_numbers
            $productNumber = new ProductNumber();
            $productNumber->product_id    = $validated['product_id'];
            $productNumber->number        = $validated['number'];
            $productNumber->vendor_number = $validated['vendor_number'] ?? null;
            $productNumber->model_number  = $validated['model_number'] ?? null;
            $productNumber->brand         = implode(',', $validated['brand']);
            $productNumber->buy_price     = $validated['buy_price'];
            $productNumber->product_brand_id     = $validated['product_brand_id'];
            $productNumber->sell_price    = $validated['sell_price'];
            $productNumber->vehicle       = implode(',', $validated['vehicle']);
            $productNumber->save();

            // 2. Ambil semua shop
            $shops = Shop::all();

            foreach ($shops as $shop) {
                $stock = new Stock();
                $stock->shop_id           = $shop->id;
                $stock->product_id        = $validated['product_id'];
                $stock->product_number_id = $productNumber->id;
                $stock->quantity          = $validated['initial_quantity'] ?? 0;
                $stock->save();

                // Optional: log stok awal
                StockLog::create([
                    'stock_id' => $stock->id,
                    'shop_id' => $shop->id,
                    'product_id' => $stock->product_id ?? null,
                    'product_number_id' => $stock->product_number_id,
                    'user_id' => auth()->id(),
                    'type' => 'in',
                    'quantity' => $stock->quantity,
                    'note' => 'Initial stock for new product part',
                    'date_created' => now(),
                    'order_id' => null, // Set to null if not applicable
                ]);
            }

            DB::commit();
            return redirect()->back()->with('message', 'Product Number and Stock for all shops added.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to add part: ' . $e->getMessage()]);
        }
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
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
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
