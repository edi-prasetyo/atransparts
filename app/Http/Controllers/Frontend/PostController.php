<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    function index()
    {
        $locale = app()->currentLocale();
        $posts = Post::with(['postTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->where('status', 1)->orderBy('id', 'desc')->paginate(2);
        // return $posts;
        return view('frontend.post.index', compact('posts'));
    }
    function show($slug)
    {
        $locale = app()->currentLocale();
        $post = Post::with(['postTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->where('slug', $slug)->first();

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $post->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $post->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $post->incrementReadCount(); //count the view
            return response()
                ->view('frontend.post.show', [
                    'post' => $post
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            // return $post;
            return view('frontend.post.show', compact('post'));
        }
    }
}
