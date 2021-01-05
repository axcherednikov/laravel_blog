<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\News\NewsController;
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
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::post('/contacts', [ContactsController::class, 'store'])->name('feedback.store');

// Route Posts
Route::get('/posts/tags/{tag}', [\App\Http\Controllers\Posts\TagsController::class, 'index'])->name('posts.tags.index');
Route::resource('/posts', '\App\Http\Controllers\Posts\PostsController');

// Route Tasks
Route::get('/tasks/tags/{tag}', [TagsController::class, 'index'])->name('tasks.tags.index');
Route::post('/tasks/{task}/step', [TaskStepsController::class, 'store'])->name('steps.store');
Route::post('/completed-steps/{step}', [CompletedStepsController::class, 'store'])->name('completed-steps.store');
Route::delete('/completed-steps/{step}', [CompletedStepsController::class, 'destroy'])->name('completed-steps.destroy');
Route::resource('/tasks', '\App\Http\Controllers\Tasks\TasksController');

//Route news
Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// Route Auth
Auth::routes();

Route::post('/companies', function () {
    auth()->user()->company()->create(request()->validate(['name' => 'required']));
})->middleware('auth');

Route::get('/service', [PushServiceController::class, 'form'])->name('service.form');
Route::post('/service', [PushServiceController::class, 'send'])->name('service.send');
