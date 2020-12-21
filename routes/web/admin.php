<?php

use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\Posts\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
})->name('home');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.show');
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostsController::class, 'edit'])->name('posts.edit');
Route::patch('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.delete');
