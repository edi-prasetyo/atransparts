<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shop;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use App\Models\StockLog;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class ReportController extends Controller
{
    // public function reportOrder(Request $request)
    // {
    //     $query = Order::with(['customer', 'shop', 'items']);

    //     if ($request->has('status') && $request->status != 'all') {
    //         $query->where('payment_status', $request->status);
    //     }
    //     if ($request->filled('start_date')) {
    //         $query->whereDate('created_at', '>=', $request->start_date);
    //     }
    //     if ($request->filled('end_date')) {
    //         $query->whereDate('created_at', '<=', $request->end_date);
    //     }
    //     if ($request->filled('shop_id') && $request->shop_id != 'all') {
    //         $query->where('shop_id', $request->shop_id);
    //     }

    //     $totalGrandAllPages = (clone $query)->sum('grand_total');
    //     $perPage = $request->get('per_page', 15);

    //     $orders = $query->orderBy('created_at', 'desc')->paginate($perPage);
    //     $totalGrandThisPage = $orders->sum('grand_total');
    //     $shops = Shop::all();

    //     if ($request->ajax()) {
    //         return view('admin.reports.partials.order_table', compact('orders', 'totalGrandAllPages', 'totalGrandThisPage'))->render();
    //     }

    //     return view('admin.reports.order', compact('orders', 'totalGrandAllPages', 'totalGrandThisPage', 'shops', 'perPage'));
    // }

    public function reportOrder(Request $request)
    {
        $query = Order::with(['customer', 'shop', 'items']);

        // Cek apakah user punya relasi shop_users
        if (auth()->user()->shop()->exists()) {
            // Ambil hanya shop_id yang dimiliki user
            $allowedShopIds = auth()->user()->shop()->pluck('shops.id')->toArray();
            $query->whereIn('shop_id', $allowedShopIds);
            $shops = auth()->user()->shop()->get();
        } else {
            // Kalau tidak punya pivot → tampilkan semua shop
            $shops = Shop::all();
        }

        // Filter status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('payment_status', $request->status);
        }

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter shop dari dropdown (aman karena sudah dibatasi di atas)
        if ($request->filled('shop_id') && $request->shop_id != 'all') {
            $query->where('shop_id', $request->shop_id);
        }

        $totalGrandAllPages = (clone $query)->sum('grand_total');
        $perPage = $request->get('per_page', 15);

        $orders = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $totalGrandThisPage = $orders->sum('grand_total');

        if ($request->ajax()) {
            return view('admin.reports.partials.order_table', compact(
                'orders',
                'totalGrandAllPages',
                'totalGrandThisPage'
            ))->render();
        }

        return view('admin.reports.order', compact(
            'orders',
            'totalGrandAllPages',
            'totalGrandThisPage',
            'shops',
            'perPage'
        ));
    }

    public function exportOrderExcel(Request $request)
    {
        return Excel::download(new OrdersExport($request), 'orders.xlsx');
    }

    public function exportOrderPdf(Request $request)
    {
        // pastikan getFilteredOrders mengembalikan collection (->get())
        $orders = $this->getFilteredOrders($request); // harus ->get() atau return collection
        if ($orders instanceof \Illuminate\Database\Eloquent\Builder) {
            $orders = $orders->get();
        }

        $totalGrand = $orders->sum('grand_total');

        $pdf = PDF::loadView('admin.reports.exports.orders_pdf', compact('orders', 'totalGrand'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('orders.pdf');
    }

    public function exportOrderWord(Request $request)
    {
        $orders = $this->getFilteredOrders($request)->get();
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText('Orders Report');
        foreach ($orders as $order) {
            $section->addText("Invoice: {$order->invoice_number}, Total: {$order->grand_total}");
        }

        $file = storage_path('app/orders.docx');
        IOFactory::createWriter($phpWord, 'Word2007')->save($file);

        return response()->download($file)->deleteFileAfterSend(true);
    }

    private function getFilteredOrders(Request $request)
    {
        $query = Order::with(['customer', 'shop']);
        if ($request->status != 'all') {
            $query->where('payment_status', $request->status);
        }
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->shop_id != 'all') {
            $query->where('shop_id', $request->shop_id);
        }
        return $query->orderBy('created_at', 'desc');
    }

    public function reportStock(Request $request)
    {
        $query = StockLog::with(['product', 'productNumber', 'shop']);

        // Filter shop
        if ($request->filled('shop_id') && $request->shop_id != 'all') {
            $query->where('shop_id', $request->shop_id);
        }

        // Filter type in/out
        if ($request->filled('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $perPage = $request->get('per_page', 10);
        $stocks = $query->orderBy('created_at', 'desc')->paginate($perPage);

        $shops = \App\Models\Shop::all();

        if ($request->ajax()) {
            return view('admin.reports.partials.stock_table', compact('stocks'))->render();
        }

        return view('admin.reports.stock', compact('stocks', 'shops', 'perPage'));
    }
    public function getOrderItems($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('admin.reports.partials.modal_items', compact('order'));
    }
}
