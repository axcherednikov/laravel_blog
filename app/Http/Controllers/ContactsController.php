<?php

namespace App\Http\Controllers;

use App\Models\Feedback;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function store()
    {
        $validatedData = $this->validate(request(), [
            'email'   => 'required|email:filter',
            'message' => 'required',
        ]);

        Feedback::create($validatedData);

        return redirect()->route('contacts');
    }
}
