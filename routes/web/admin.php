<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

// Route Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route Feedback
Route::resource('/feedback', '\App\Http\Controllers\Admin\FeedbackController')->only('index', 'destroy');

// Route Posts
Route::resource('/posts', '\App\Http\Controllers\Admin\Posts\PostsController')->only('index', 'edit', 'update', 'destroy');

// Route News
Route::resource('/news', '\App\Http\Controllers\Admin\News\NewsController');

// Route Reports
Route::resource('/reports', '\App\Http\Controllers\Admin\ReportsController')->only('index');
