<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/about', function () {

    $title = 'О нас';

    return view('about', compact('title'));
})->name('about');

// Route Home
Route::get('/', 'Posts\PostsController@index')->name('home');

// Route FeedBack
Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::post('/contacts', 'ContactsController@store')->name('feedback.store');

// Route Posts
Route::get('/posts/tags/{tag}', 'Posts\TagsController@index')->name('posts.tags.index');
Route::resource('/posts', 'Posts\PostsController');

// Route Tasks
Route::get('/tasks/tags/{tag}', 'Tasks\TagsController@index')->name('tasks.tags.index');
Route::post('/tasks/{task}/step', 'Tasks\TaskStepsController@store')->name('steps.store');
Route::post('/completed-steps/{step}', 'Tasks\CompletedStepsController@store')->name('completed-steps.store');
Route::delete('/completed-steps/{step}', 'Tasks\CompletedStepsController@destroy')->name('completed-steps.destroy');
Route::resource('/tasks', 'Tasks\TasksController');

// Route Auth
Auth::routes();

Route::post('/companies', function () {
    auth()->user()->company()->create(request()->validate(['name' => 'required']));
})->middleware('auth');

Route::get('/service', 'PushServiceController@form')->name('service.form');
Route::post('/service', 'PushServiceController@send')->name('service.send');

Route::get('/test', function () {
    return view('test');
});
