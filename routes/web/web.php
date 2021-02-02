<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Posts\CommentsController;
use App\Http\Controllers\Posts\PostsController;
use App\Http\Controllers\PushServiceController;
use App\Http\Controllers\Tasks\CompletedStepsController;
use App\Http\Controllers\Tasks\TagsController;
use App\Http\Controllers\Tasks\TaskStepsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Route Home
Route::get('/', [PostsController::class, 'index'])->name('home');

// Route FeedBack
Route::resource('/contacts', '\App\Http\Controllers\ContactsController')->only('index', 'store');

// Route Posts
Route::get('/posts/tags/{tag}', [\App\Http\Controllers\Posts\TagsController::class, 'index'])->name('posts.tags.index');
Route::post('/posts/comments/{post}', [CommentsController::class, 'store'])->name('posts.comments.store');

Route::resource('/posts', '\App\Http\Controllers\Posts\PostsController');

// Route Tasks
Route::get('/tasks/tags/{tag}', [TagsController::class, 'index'])->name('tasks.tags.index');
Route::post('/tasks/{task}/step', [TaskStepsController::class, 'store'])->name('steps.store');
Route::post('/completed-steps/{step}', [CompletedStepsController::class, 'store'])->name('completed-steps.store');
Route::delete('/completed-steps/{step}', [CompletedStepsController::class, 'destroy'])->name('completed-steps.destroy');

Route::resource('/tasks', '\App\Http\Controllers\Tasks\TasksController');

//Route news
Route::get('/news/tags/{tag}', [\App\Http\Controllers\News\TagsController::class, 'index'])->name('news.tags.index');

Route::resource('/news', '\App\Http\Controllers\News\NewsController')->only('index', 'show');

// Route Auth
Auth::routes();

Route::post('/companies', function () {
    auth()->user()->company()->create(request()->validate(['name' => 'required']));
})->middleware('auth');

Route::get('/service', [PushServiceController::class, 'form'])->name('service.form');
Route::post('/service', [PushServiceController::class, 'send'])->name('service.send');
