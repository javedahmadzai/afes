<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Mail;
use App\Http\Requests\SendMessage;
use App\Mail\Contact;
use App\Message;

class ContactController extends Controller
{
    public function index()
    {
        return View::make('contact.index');
    }

    public function mail(SendMessage $request)
    {
        Mail::send(new Contact(Message::create($request->validated())));

        return back();
    }
}
