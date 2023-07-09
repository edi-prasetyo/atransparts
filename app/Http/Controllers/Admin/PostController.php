<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    function index()
    {
        $posts = Post::orderBy('id', 'asc')->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
    function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }
    function store(PostFormRequest $request)
    {
        $validatedData = $request->validated();
        $slugRequest = Str::slug($validatedData['slug']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $post = new Post;
        $post->category_id = $validatedData['category_id'];
        $post->user_id = $validatedData['user_id'];
        if (Post::where('slug', $slugRequest)->exists()) {
            $post->slug = $slug;
        } else {
            $post->slug = $slugRequest;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/posts/', $filename);
            $post->image = $filename;
        }
        $post->status = $request->status == true ? '1' : '0';

        $post->save();
        return redirect('admin/posts/show/' . $post->id)->with('message', 'Post Has Added');
    }
    function show(int $post_id)
    {
        $post = Post::findOrFail($post_id);
        $postTranslate = PostTranslation::where('post_id', $post_id)->get();

        return view('admin.post.show', compact('post', 'postTranslate'));
    }
    function add_translate(Request $request)
    {
        $post_translate = new PostTranslation;
        $post_translate->post_id = $request['post_id'];
        $post_translate->locale = $request['locale'];
        $post_translate->title = $request['title'];
        $post_translate->content = $request['content'];
        $post_translate->meta_title = $request['meta_title'];
        $post_translate->meta_keyword = $request['meta_keyword'];
        $post_translate->meta_description = $request['meta_description'];

        $post_translate->save();
        return redirect()->back()->with('message', 'Post Translate Has Added');
    }
    function edit(int $post)
    {
        $categories = Category::all();
        return view('admin.post.edit', compact('categories'));
    }
    public function destroy(int $post_id)
    {
        $post = Post::findOrFail($post_id);
        $path = 'uploads/posts/' . $post->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $post->delete();
        return redirect()->back()->with('message', 'Product and Image was Deleted!');
    }
}
