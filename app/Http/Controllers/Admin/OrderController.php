<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Option;
use App\Models\Product;
use App\Models\ShopUser;
use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;



class OrderController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        // Ambil semua shop_id dari pivot table shop_users
        $shopIds = DB::table('shop_users')
            ->where('user_id', $user_id)
            ->pluck('shop_id');

        // Query orders
        $ordersQuery = Order::with('customer')
            ->orderBy('id', 'desc');

        // Jika user punya shop_id, filter order sesuai shop
        if ($shopIds->isNotEmpty()) {
            $ordersQuery->whereIn('shop_id', $shopIds);
        }

        $orders = $ordersQuery->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $site = Option::first();
        $order = Order::where('id', $id)
            ->with(['customer', 'shop', 'items.product', 'items.productNumber'])
            ->first();
        // return $order;
        return view('admin.order.show', compact('order', 'site'));
    }

    public function create()
    {
        // Logic to show the form for creating a new order
        return view('admin.order.create');
    }

    public function store(Request $request)
    {
        try {
            // Log data request sebelum validasi
            Log::info('Order store - request data:', $request->all());

            $request->validate([
                'customer_id' => 'nullable|exists:customers,id',
                'full_name' => 'required_without:customer_id|string',
                'phone' => 'required_without:customer_id|string',
                'address' => 'nullable',
                'payment_method' => 'required|in:cash,transfer,qris,payment gateway',
                'items' => 'required|array|min:1',
                'items.*.product_number_id' => 'required|exists:product_numbers,id',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.price' => 'required|integer|min:0',
                'discount' => 'required|numeric|min:0',
            ]);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            // Log error validasi lengkap
            Log::error('Validation error saat simpan order:', [
                'errors' => $ve->errors(),
                'input' => $request->all()
            ]);

            // Redirect balik dengan error validasi
            return redirect()->back()
                ->withErrors($ve->errors())
                ->withInput();
        } catch (\Throwable $e) {
            // Log error lain jika ada
            Log::error('Error tidak terduga saat validasi order:', [
                'message' => $e->getMessage(),
                'input' => $request->all()
            ]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat validasi.']);
        }

        // Jika validasi sukses lanjutkan simpan data
        DB::beginTransaction();

        try {
            // 1. Simpan atau ambil customer
            if ($request->customer_id) {
                $customer = Customer::find($request->customer_id);
                Log::info("Menggunakan customer ID: {$request->customer_id}");
            } else {

                $shopId = ShopUser::where('user_id', Auth::id())
                    ->value('shop_id');
                $customer = Customer::create([
                    'full_name' => $request->full_name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'shop_id'   => $shopId,
                ]);
                Log::info("Membuat customer baru dengan ID: {$customer->id}");
            }

            // 2. Hitung total dan quantity
            $items = $request->items;
            $totalAmount = collect($items)->sum(fn($item) => $item['price'] * $item['quantity']);
            $grandTotal = $totalAmount - $request->discount;
            $totalQty = collect($items)->sum('quantity');

            $user_id = Auth::id();
            // Coba ambil shop_id dari shop_users
            $shopUser = ShopUser::where('user_id', $user_id)->first();
            $shop_id = $shopUser ? $shopUser->shop_id : null;


            // ✅ CEK STOK DI SINI
            foreach ($items as $item) {
                $stock = Stock::where('shop_id', $shop_id)
                    ->where('product_id', $item['product_id'])
                    ->where('product_number_id', $item['product_number_id'])
                    ->first();

                if (!$stock || $stock->quantity < $item['quantity']) {
                    $namaProduk = Product::find($item['product_id'])->name ?? 'Produk Tidak Dikenal';
                    $jumlahStok = $stock ? $stock->quantity : 0;

                    return redirect()->back()
                        ->withErrors(["Stok untuk {$namaProduk} tidak mencukupi. Tersisa {$jumlahStok}, diminta {$item['quantity']}."])
                        ->withInput();
                }
            }

            // 3. Simpan order
            $order = Order::create([
                'customer_id' => $customer->id,
                'user_id' => $user_id,
                'shop_id' => $shop_id,
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->address,
                'total_price' => $totalAmount,
                'discount' => $request->discount,
                'grand_total' => $grandTotal,
                'quantity' => $totalQty,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            ]);
            $invoiceNumber = str_pad($order->id, 8, '0', STR_PAD_LEFT); // padding 0 sampai 8 digit
            $order->invoice_number = 'INV-' . $invoiceNumber;
            $order->save();



            // 4. Simpan item
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_number_id' => $item['product_number_id'], // Simpan juga kalau ingin tracking nomor produk
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);

                // Kurangi stok
                $stock->decrement('quantity', $item['quantity']);

                // Simpan log stok
                StockLog::create([
                    'shop_id' => $shop_id,
                    'user_id' => $user_id,
                    'product_id' => $item['product_id'],
                    'product_number_id' => $item['product_number_id'],
                    'stock_id' => $stock->id,
                    'date_created' => now(),
                    'type' => 'out',
                    'quantity' => $item['quantity'],
                    'order_id' => $order->id,
                    'note' => 'Order baru ID ' . $order->id,
                ]);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error('Gagal menyimpan order:', [
                'message' => $e->getMessage(),
                'input' => $request->all()
            ]);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan order. ' . $e->getMessage()]);
        }
    }

    public function markPaid($id)
    {
        $order = Order::findOrFail($id);
        $order->payment_status = 'paid';
        $order->save();

        return redirect()->back()->with('message', 'Payment status berhasil diupdate menjadi Paid.');
    }
}
