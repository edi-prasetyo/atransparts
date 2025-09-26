<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductBrandController extends Controller
{
    public function index()
    {
        $brands = ProductBrand::latest()->get();
        return view('admin.product_brand.index', compact('brands'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:product_brands,name',
            'slug' => 'nullable|string|max:100|unique:product_brands,slug',
            'status' => 'required|in:0,1',
            'image' => 'nullable',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/brand'), $filename);
            $validated['image'] = 'uploads/brand/' . $filename;
        }

        ProductBrand::create($validated);
        return redirect()->back()->with('success', 'Brand created.');
    }

    public function update(Request $request, ProductBrand $productBrand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:product_brands,name,' . $productBrand->id,
            'slug' => 'nullable|string|max:100|unique:product_brands,slug,' . $productBrand->id,
            'status' => 'required|in:0,1',
            'image' => 'nullable',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            // Hapus file lama kalau ada
            if ($productBrand->image && file_exists(public_path($productBrand->image))) {
                unlink(public_path($productBrand->image));
            }
            $filename = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/brand'), $filename);
            $validated['image'] = 'uploads/brand/' . $filename;
        }

        $productBrand->update($validated);
        return redirect()->back()->with('success', 'Brand updated.');
    }

    public function destroy(ProductBrand $productBrand)
    {
        $productBrand->delete();
        return redirect()->back()->with('success', 'Brand deleted.');
    }
}
