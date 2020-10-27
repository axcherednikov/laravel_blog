<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/create', 'PostsController@create')->name('post.create');
Route::post('/posts', 'PostsController@store')->name('post.store');
Route::get('/posts/{post}', 'PostsController@show')->name('post.show');

Route::get('/about', function () {

    $title = 'О нас';

    return view('about', compact('title'));
})->name('about');

Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::post('/contacts', 'FeedbackController@store')->name('feedback.store');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.home');

Route::get('/admin/feedback', 'FeedbackController@index')->name('feedback.show');

Route::get('/tasks', 'TasksController@index')->name('tasks');
Route::get('/tasks/create', 'TasksController@create')->name('task.create');
Route::post('/tasks', 'TasksController@store')->name('task.store');
Route::get('/tasks/{task}', 'TasksController@show')->name('task.show');
