<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function index()
    {
    }
    function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ]);

        $message = new Message();
        $message->name = $validated['name'];
        $message->phone = $validated['phone'];
        $message->message = $validated['message'];
        $message->status_read = 0;
        $message->save();
        return redirect()->back()->with('message', 'Pesan telah Di kirim');
    }
}
