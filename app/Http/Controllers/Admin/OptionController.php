<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OptionController extends Controller
{
    function index()
    {
        $option = Option::first();
        return view('admin.option.index', compact('option'));
    }
    function update(Request $request)
    {
        $option = Option::first();
        $option->title = $request['title'];
        $option->tagline = $request['tagline'];
        $option->description = $request['description'];
        $option->keywords = $request['keywords'];
        $option->google_meta = $request['google_meta'];
        $option->bing_meta = $request['bing_meta'];
        $option->google_analytics = $request['google_analytics'];
        $option->google_tag = $request['google_tag'];
        $option->email = $request['email'];
        $option->phone = $request['phone'];
        $option->whatsapp = $request['whatsapp'];
        $option->address = $request['address'];
        $option->link = $request['link'];
        $option->facebook = $request['facebook'];
        $option->instagram = $request['instagram'];
        $option->tiktok = $request['tiktok'];
        $option->twitter = $request['twitter'];
        $option->maps = $request['maps'];


        if ($request->hasFile('logo')) {
            $path = 'uploads/logo/' . $option->logo;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $option->logo = $filename;
        }
        if ($request->hasFile('second_logo')) {
            $path = 'uploads/logo/' . $option->second_logo;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('second_logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $option->second_logo = $filename;
        }
        if ($request->hasFile('favicon')) {
            $path = 'uploads/logo/' . $option->favicon;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('favicon');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $option->favicon = $filename;
        }

        $option->update();
        return redirect('admin/options')->with('message', 'Option update Succesfully');
    }
}
