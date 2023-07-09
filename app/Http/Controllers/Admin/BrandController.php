<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }
    public function create()
    {
        return view('admin.brand.create');
    }
    public function store(BrandFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $brand = new Brand;
        $brand->name = $validatedData['name'];
        if (Brand::where('slug', $slugRequest)->exists()) {
            $brand->slug = $slug;
        } else {
            $brand->slug = $slugRequest;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $brand->image = $filename;
        }
        $brand->status = $request->status == true ? '1' : '0';

        $brand->save();
        return redirect('admin/brands')->with('message', 'Brands Has Added');
    }
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }
    public function update(BrandFormRequest $request, $brand)
    {
        $validatedData = $request->validated();
        $brand = Brand::findOrFail($brand);

        $brand->name = $validatedData['name'];

        if ($request->hasFile('image')) {

            $path = 'uploads/brand/' . $brand->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $brand->image = $filename;
        }
        $brand->status = $request->status == true ? '1' : '0';

        $brand->update();
        return redirect('admin/brands')->with('message', 'Brand update Succesfully');
    }
}
