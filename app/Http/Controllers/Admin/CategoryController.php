<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategoryController extends Controller
{
    public $category_id;
    public function index()
    {
        $categories =  Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['slug']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $category = new Category;
        if (Category::where('slug', $slugRequest)->exists()) {
            $category->slug = $slug;
        } else {
            $category->slug = $slugRequest;
        }

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }
        $category->status = $request->status == true ? '1' : '0';

        $category->save();
        return redirect('admin/category/show/' . $category->id)->with('message', 'Category Has Added');
    }
    function show(int $category_id)
    {
        $category = Category::findOrFail($category_id);
        $categoryTranslate = CategoryTranslation::all();

        return view('admin.category.show', compact('category', 'categoryTranslate'));
    }
    function add_translate(Request $request)
    {
        $category_translate = new CategoryTranslation;
        $category_translate->category_id = $request['category_id'];
        $category_translate->name = $request['name'];
        $category_translate->locale = $request['locale'];
        $category_translate->name = $request['name'];
        $category_translate->description = $request['description'];
        $category_translate->meta_title = $request['meta_title'];
        $category_translate->meta_description = $request['meta_description'];
        $category_translate->meta_keyword = $request['meta_keyword'];

        $category_translate->save();
        return redirect()->back()->with('message', 'Category Has Added');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {

            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1' : '0';

        $category->update();
        return redirect('admin/category')->with('message', 'Category update Succesfully');
    }
}
