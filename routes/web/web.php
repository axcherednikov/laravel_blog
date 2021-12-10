<?php

use App\Events\ChatMessage;
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

// Route Tags
Route::get('/tags/{tag}', [\App\Http\Controllers\Tags\TagsController::class, 'index'])->name('tags.index');

// Route Posts
Route::post('/posts/comments/{post}', [CommentsController::class, 'store'])->name('posts.comments.store');
Route::delete('/posts/comments/{comment}', [\App\Http\Controllers\Comments\CommentsController::class, 'destroy'])
    ->name('posts.comment.destroy');

Route::resource('/posts', '\App\Http\Controllers\Posts\PostsController');

// Route Tasks
Route::get('/tasks/tags/{tag}', [TagsController::class, 'index'])->name('tasks.tags.index');
Route::post('/tasks/{task}/step', [TaskStepsController::class, 'store'])->name('steps.store');
Route::post('/completed-steps/{step}', [CompletedStepsController::class, 'store'])->name('completed-steps.store');
Route::delete('/completed-steps/{step}', [CompletedStepsController::class, 'destroy'])->name('completed-steps.destroy');
Route::resource('/tasks', '\App\Http\Controllers\Tasks\TasksController');

//Route news
Route::post('/news/comments/{news}', [\App\Http\Controllers\News\CommentsController::class, 'store'])
    ->name('news.comments.store');
Route::delete('/news/comments/{comment}', [\App\Http\Controllers\Comments\CommentsController::class, 'destroy'])
    ->name('news.comments.destroy');

Route::resource('/news', '\App\Http\Controllers\News\NewsController')->only('index', 'show');

// Route Auth
Auth::routes();

Route::post('/companies', function() {
    auth()->user()->company()->create(request()->validate(['name' => 'required']));
})->middleware('auth');

Route::get('/service', [PushServiceController::class, 'form'])->name('service.form');
Route::post('/service', [PushServiceController::class, 'send'])->name('service.send');

Route::post('/chat', function() {
    broadcast(new ChatMessage(request('message'), auth()->user()))->toOthers();
})->middleware('auth');
