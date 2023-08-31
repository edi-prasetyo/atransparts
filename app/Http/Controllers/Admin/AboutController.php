<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    function index()
    {
        $about = About::first();
        $aboutTranslate = AboutTranslation::all();
        return view('admin.about.index', compact('about', 'aboutTranslate'));
    }
    function update(Request $request)
    {
        $about = About::first();
        if ($request->hasFile('image')) {
            $path = 'uploads/posts/' . $about->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/posts/', $filename);
            $about->image = $filename;
        }
        $about->update();
        return redirect()->back()->with('message', 'Image Has Updated');
    }
    function add_translate(Request $request)
    {
        $about_translate = new AboutTranslation();
        $about_translate->about_id = $request['about_id'];
        $about_translate->locale = $request['locale'];
        $about_translate->title = $request['title'];
        $about_translate->content = $request['content'];
        $about_translate->save();
        return redirect()->back()->with('message', 'About Translaaate Has Added');
    }

    function edit_translate(int $translate_id)
    {
        $about_translate = AboutTranslation::where('id', $translate_id)->first();
        return view('admin.about.edit', compact('about_translate'));
    }
    function update_translate(Request $request, int $translate_id)
    {
        $about_translate = AboutTranslation::where('id', $translate_id)->first();
        $about_translate->title = $request['title'];
        $about_translate->content = $request['content'];
        $about_translate->update();
        return redirect('admin/abouts')->with('message', 'About Translaaate Has Added');
    }
}
