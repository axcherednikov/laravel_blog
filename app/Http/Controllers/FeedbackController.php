<?php

namespace App\Http\Controllers;

use App\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();

        return view('admin.feedback', compact('feedbacks'));
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
