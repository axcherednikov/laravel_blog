<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->simplePaginate(5);

        return view('admin.feedback', compact('feedbacks'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        flash('Обращение удалено', 'danger');

        return back();
    }
}
