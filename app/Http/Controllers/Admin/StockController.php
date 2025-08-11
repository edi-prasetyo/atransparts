<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopUser;
use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{


    public function index(Request $request)
    {
        $query = Stock::with(['product', 'productNumber', 'shop'])
            ->join('product_numbers', 'stocks.product_number_id', '=', 'product_numbers.id')
            ->join('products', 'stocks.product_id', '=', 'products.id')
            ->select('stocks.*') // agar pagination tidak error
            ->orderBy('quantity', 'desc');

        if ($request->filled('shop_id')) {
            $query->where('stocks.shop_id', $request->shop_id);
        }

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('products.name', 'like', "%{$keyword}%")
                    ->orWhere('product_numbers.number', 'like', "%{$keyword}%")
                    ->orWhere('product_numbers.model_number', 'like', "%{$keyword}%");
            });
        }

        $products = $query->paginate(10)->appends($request->only('shop_id', 'keyword'));
        $shops = Shop::all();

        return view('admin.stock.index', compact('products', 'shops'));
    }
    public function create($id)
    {
        $stock = Stock::with('product', 'productNumber', 'shop')->findOrFail($id);
        $log = StockLog::with('user')
            ->where('stock_id', $id)
            ->orderBy('date_created', 'desc')
            ->paginate(10);

        if (!$stock) {
            return redirect()->back()->withErrors(['Stock not found']);
        }

        // Cek apakah stok sudah ada
        if ($log->isEmpty()) {
            return redirect()->back()->withErrors(['Log stok tidak ditemukan']);
        }
        // return $log;
        return view('admin.stock.create', compact('stock', 'log'));
    }
    public function store(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);

        $validated = $request->validate([
            'type'     => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note'     => 'nullable|string|max:255',
        ]);

        // Cek jika stok mencukupi saat type 'out'
        if ($validated['type'] === 'out' && $validated['quantity'] > $stock->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi untuk pengurangan ini.'])->withInput();
        }

        $log = StockLog::create([
            'stock_id'          => $stock->id,
            'shop_id'           => $stock->shop_id,
            'product_id'        => $stock->product_id,
            'product_number_id' => $stock->product_number_id,
            'user_id'           => auth()->id(),
            'type'              => $validated['type'],
            'quantity'          => $validated['quantity'],
            'date_created'      => now(),
            'note'              => $validated['note'],
        ]);

        // Update quantity di stock
        if ($validated['type'] === 'in') {
            $stock->increment('quantity', $validated['quantity']);
        } else {
            $stock->decrement('quantity', $validated['quantity']);
        }

        return redirect()->back()->with('success', 'Log stok berhasil ditambahkan.');
    }
    public function show(Stock $stock)
    {
        return view('admin.stock.show', compact('stock'));
    }
    public function index_shop(Request $request)
    {
        $user = Auth::user(); // Ambil ID toko dari user yang sedang login
        $shop = ShopUser::where('user_id', $user->id)->first();
        $shop_id = $shop ? $shop->id : null;
        // return $shop_id;

        $query = Stock::with(['product', 'productNumber'])
            ->where('shop_id', $shop_id)
            ->orderBy('quantity', 'desc');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('productNumber', function ($sub) use ($keyword) {
                    $sub->where('number', 'like', "%{$keyword}%")
                        ->orWhere('model_number', 'like', "%{$keyword}%");
                })->orWhereHas('product', function ($sub) use ($keyword) {
                    $sub->where('name', 'like', "%{$keyword}%");
                });
            });
        }

        $products = $query->paginate(10)->appends($request->only('keyword'));
        return view('admin.stock.index_shop', compact('products'));
    }

    public function create_shop()
    {
        $user = Auth::user(); // Ambil ID toko dari user yang sedang login
        $shop = ShopUser::with('shop')
            ->where('user_id', $user->id)
            ->first();
        $shop_id = $shop ? $shop->id : null;

        return view('admin.stock.create', compact('shops'));
    }

    public function check(Request $request)
    {
        $shop_id = ShopUser::where('user_id', auth()->id())->value('shop_id');

        $stock = Stock::where('shop_id', $shop_id)
            ->where('product_id', $request->product_id)
            ->where('product_number_id', $request->product_number_id)
            ->first();

        if (!$stock) {
            return response()->json(['status' => 'not_found', 'message' => 'Stok tidak ditemukan.'], 404);
        }

        if ($request->quantity > $stock->quantity) {
            return response()->json([
                'status' => 'error',
                'available' => $stock->quantity,
                'message' => 'Stok tidak mencukupi.'
            ], 200); // ganti ke 200 untuk tes (sementara)
        }

        return response()->json(['status' => 'ok']);
    }
}
