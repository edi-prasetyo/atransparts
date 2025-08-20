<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Warranty;
use Illuminate\Support\Carbon;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = Warranty::with('productNumber.product')->latest()->get();
        $productNumbers   = ProductNumber::with(['product'])->get();
        // return $warranties;
        return view('admin.warranties.index', compact('warranties', 'productNumbers'));
    }
    public function create()
    {
        $productNumbers = ProductNumber::all();
        return view('addmin.warranties.create', compact('productNumbers'));
    }
    // 1. Buat data garansi & QR Code
    public function store(Request $request)
    {
        $request->validate([
            'product_number_id' => 'required|exists:product_numbers,id',
        ]);

        $code = strtolower(Str::random(64));
        $qrData = route('warranty.activate', ['code' => $code]);

        $folderPath = public_path('uploads/warranty');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Gunakan SVG
        $qrFileName = 'qr_' . $code . '.svg';
        $qrFullPath = $folderPath . '/' . $qrFileName;

        // Simpan file SVG (tidak butuh Imagick)
        $svgData = QrCode::size(300)->generate($qrData);
        file_put_contents($qrFullPath, $svgData);

        Warranty::create([
            'product_number_id' => $request->product_number_id,
            'code'       => $code,
            'qr_image'   => 'uploads/warranty/' . $qrFileName,
        ]);

        return redirect()->route('warranties.index')
            ->with('success', 'Data garansi berhasil dibuat.');
    }

    public function show($id)
    {
        $warranty = Warranty::find($id);
        return view('admin.warranties.show', compact('warranty'));
    }
    public function claim($id)
    {
        $warranty = Warranty::findOrFail($id);

        if ($warranty->claim == 1) {
            $warranty->update([
                'claim' => 0,
                'claim_status' => 1,
                'claim_date' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Garansi berhasil diklaim.');
    }

    // public function activateForm($code)
    // {
    //     $warranty = Warranty::where('code', $code)->firstOrFail();
    //     return view('frontend.warranties.activate', compact('warranty'));
    // }
    // public function activateStore(Request $request, $code)
    // {
    //     $warranty = Warranty::where('code', $code)->firstOrFail();

    //     $request->validate([
    //         'customer_name' => 'required|string|max:255',
    //         'phone'         => 'required|string|max:20',
    //         'nopol'         => 'nullable|string|max:20',
    //         'km'            => 'nullable|string|max:20',
    //         'active_until'  => 'required|date',
    //     ]);

    //     $warranty->update([
    //         'customer_name' => $request->customer_name,
    //         'phone'         => $request->phone,
    //         'nopol'         => $request->nopol,
    //         'km'            => $request->km,
    //         'active_until'  => $request->active_until,
    //         'status'        => 1,
    //     ]);

    //     return redirect()->route('warranty.activated', ['code' => $warranty->code])
    //         ->with('success', 'Garansi berhasil diaktifkan.');
    // }

    // // 4. Halaman sukses aktivasi
    // public function activated($code)
    // {
    //     $warranty = Warranty::where('code', $code)->firstOrFail();
    //     return view('frontend.warranties.activated', compact('warranty'));
    // }
}
