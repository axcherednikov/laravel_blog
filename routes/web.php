<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/about', function () {

    $title = 'О нас';

    return view('about', compact('title'));
})->name('about');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.home');

Route::get('/posts/tags/{tag}', 'Posts\TagsController@index')->name('posts.tags.index');
Route::get('/', 'Posts\PostsController@index')->name('home');

Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::post('/contacts', 'FeedbackController@store')->name('feedback.store');

Route::get('/admin/feedback', 'FeedbackController@index')->name('feedback.show');

Route::resource('/posts', 'Posts\PostsController');

Route::get('/tasks/tags/{tag}', 'Tasks\TagsController@index')->name('tags.index');
Route::resource('/tasks', 'Tasks\TasksController');
Route::post('/tasks/{task}/step', 'Tasks\TaskStepsController@store')->name('steps.store');

Route::post('/completed-steps/{step}', 'Tasks\CompletedStepsController@store')->name('completed-steps.store');
Route::delete('/completed-steps/{step}', 'Tasks\CompletedStepsController@destroy')->name('completed-steps.destroy');

Auth::routes();
