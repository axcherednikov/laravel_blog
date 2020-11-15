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

Route::get('/', 'PostsController@index')->name('home');

Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::post('/contacts', 'FeedbackController@store')->name('feedback.store');

Route::get('/admin/feedback', 'FeedbackController@index')->name('feedback.show');

Route::resource('/posts', 'PostsController');

Route::get('/tasks/tags/{tag}', 'TagsController@index')->name('tags.index');
Route::resource('/tasks', 'TasksController');
Route::post('/tasks/{task}/step', 'TaskStepsController@store')->name('steps.store');

Route::post('/completed-steps/{step}', 'CompletedStepsController@store')->name('completed-steps.store');
Route::delete('/completed-steps/{step}', 'CompletedStepsController@destroy')->name('completed-steps.destroy');

Auth::routes();
