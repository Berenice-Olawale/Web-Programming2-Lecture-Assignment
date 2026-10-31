<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
   {
       public function create()
       {
           return view('contact');
       }

       public function store(Request $request)
       {
           $validated = $request->validate([
               'name'    => 'required|string|max:100',
               'email'   => 'required|email|max:150',
               'subject' => 'required|string|max:150',
               'message' => 'required|string|min:10|max:2000',
           ]);

           Message::create($validated);

           return redirect()->route('contact.create')
               ->with('success', 'Thank you! Your message has been sent.');
       }
   }