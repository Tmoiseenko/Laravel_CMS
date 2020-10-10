<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// posts
Route::get('/', 'PostsController@index')->name('home');
Route::get('/post/tag/{tag}', 'TagsController@index')->name('tag.show');
Route::resource('/post', 'PostsController');

//pages
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');

//feedback
Route::get('/admin/feedback', 'FeedbackController@feedback')->name('feedback.show');
Route::post('/admin/feedback', 'FeedbackController@feedbackCreate')->name('feedback.create');

Auth::routes();

