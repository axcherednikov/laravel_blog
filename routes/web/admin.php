<?php

use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\Posts\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
})->name('home');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.show');

Route::resource('/posts', '\App\Http\Controllers\Admin\Posts\PostsController');
