<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class WarrantyController extends Controller
{
    public function index()
    {
        return view('frontend.warranties.index');
    }
    public function activateForm($code)
    {
        $warranty = Warranty::where('code', $code)->firstOrFail();
        if ($warranty->status == 1) {
            return redirect('frontend.warranties.activated', $code);
        }
        return view('frontend.warranties.activate', compact('warranty'));
    }
    public function activateStore(Request $request, $code)
    {
        $warranty = Warranty::where('code', $code)->firstOrFail();

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'nopol'         => 'nullable|string|max:20',
            'km'            => 'nullable|string|max:20',

        ]);

        $warrantyCode = strtoupper(Str::random(6));

        $warranty->update([
            'warranty_code' => $warrantyCode,
            'customer_name' => $request->customer_name,
            'phone'         => $request->phone,
            'nopol'         => $request->nopol,
            'km'            => $request->km,
            'active_until'  => Carbon::now()->addMonth(),
            'status'        => 1,
        ]);

        return redirect()->route('warranty.activated', ['code' => $warranty->code])
            ->with('success', 'Garansi berhasil diaktifkan.');
    }

    public function check(Request $request)
    {
        $request->validate([
            'warranty_code' => 'required|string',
        ]);

        $warranty = Warranty::where('warranty_code', $request->warranty_code)->first();

        if ($warranty) {
            return redirect()->route('warranty.activated', ['code' => $warranty->code]);
        }

        return redirect()->route('warranty.index')->withErrors([
            'warranty_code' => 'Kode garansi tidak ditemukan.',
        ])->withInput();
    }
    public function activated($code)
    {
        $warranty = Warranty::where('code', $code)->firstOrFail();
        return view('frontend.warranties.activated', compact('warranty'));
    }

    public function clainForm($code) {}
    public function claimSend(Request $request, $code)
    {
        // Validasi input note dari user
        $request->validate([
            'note' => 'required|string|max:255',
        ]);

        // Cari warranty berdasarkan code
        $warranty = Warranty::where('code', $code)->firstOrFail();

        // Update data warranty
        $warranty->update([
            'claim' => 1,
            'note'  => $request->note,
        ]);

        return redirect()->back()->with('message', 'Claim berhasil dikirim.');
    }
}
