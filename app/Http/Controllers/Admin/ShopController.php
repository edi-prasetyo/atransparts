<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Province;
use App\Models\City;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['province', 'city'])->latest()->get();
        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        $provinces = Province::all();
        $cities = City::all();
        return view('admin.shops.create', compact('provinces', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'map' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            $shop = Shop::create($validated);

            // Ambil semua product + product number
            $products = Product::with('productNumbers')->get();

            foreach ($products as $product) {
                foreach ($product->productNumbers as $productNumber) {
                    // 1. Buat stok
                    $stock = Stock::create([
                        'shop_id'            => $shop->id,
                        'product_id'         => $product->id,
                        'product_number_id'  => $productNumber->id,
                        'quantity'           => 0
                    ]);

                    // 2. Buat log stok
                    StockLog::create([
                        'shop_id'            => $shop->id,
                        'user_id'            => auth()->id(),
                        'product_id'         => $product->id,
                        'product_number_id'  => $productNumber->id,
                        'stock_id'           => $stock->id,
                        'date_created'       => now(),
                        'type'               => 'in',
                        'quantity'           => 0,
                        'order_id'           => null,
                        'note'               => 'Inisialisasi stok saat membuat toko'
                    ]);
                }
            }
        });

        return redirect()->route('shops.index')->with('success', 'Toko berhasil dibuat dan stok diinisialisasi.');
    }

    public function show(Shop $shop)
    {
        return view('admin.shops.show', compact('shop'));
    }

    public function edit(Shop $shop)
    {
        $provinces = Province::all();
        $cities = City::all();
        return view('admin.shops.edit', compact('shop', 'provinces', 'cities'));
    }

    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'map' => 'nullable|string',
        ]);

        $shop->update($validated);

        return redirect()->route('shops.index')->with('success', 'Shop updated successfully.');
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Shop deleted successfully.');
    }
}
