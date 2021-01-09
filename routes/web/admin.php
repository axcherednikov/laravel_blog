<?php

use App\Http\Controllers\Admin\FeedbackController;
use Illuminate\Support\Facades\Route;

// Route Home
Route::get('/', function () {
    return view('admin.index');
})->name('home');

// Route Feedback
Route::resource('/feedback', '\App\Http\Controllers\Admin\FeedbackController')->only('index', 'destroy');

// Route Posts
Route::resource('/posts', '\App\Http\Controllers\Admin\Posts\PostsController')->only('index', 'edit', 'update', 'destroy');

// Route News
Route::resource('/news', '\App\Http\Controllers\Admin\News\NewsController');
