<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductionFormRequest;
use App\Models\Production;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index()
    {
        $productions = Production::orderBy('id', 'DESC')->paginate(10);
        return view('admin.production.index', compact('productions'));
    }
    public function create()
    {
        return view('admin.production.create');
    }
    public function store(ProductionFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $production = new Production;
        $production->name = $validatedData['name'];
        $production->country = $validatedData['country'];
        if (Production::where('slug', $slugRequest)->exists()) {
            $production->slug = $slug;
        } else {
            $production->slug = $slugRequest;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $production->image = $filename;
        }
        $production->status = $request->status == true ? '1' : '0';

        $production->save();
        return redirect('admin/productions')->with('message', 'Production Has Added');
    }
    public function edit(Production $production)
    {
        return view('admin.production.edit', compact('production'));
    }
    public function update(ProductionFormRequest $request, $production)
    {
        $validatedData = $request->validated();
        $production = Production::findOrFail($production);

        $production->name = $validatedData['name'];
        $production->country = $validatedData['country'];

        if ($request->hasFile('image')) {

            $path = 'uploads/logo/' . $production->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/production/', $filename);
            $production->image = $filename;
        }
        $production->status = $request->status == true ? '1' : '0';

        $production->update();
        return redirect('admin/productions')->with('message', 'Production update Succesfully');
    }
}
