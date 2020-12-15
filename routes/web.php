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
Route::get('tag/{tag}', 'TagsController@index')->name('tag.show');
Route::resource('post', 'PostsController');

Route::get('news', 'NewsController@index')->name('news');
Route::get('news/{news}', 'NewsController@show')->name('news.show');

//pages
Route::get('about', 'PagesController@about')->name('about');
Route::get('contact', 'PagesController@contact')->name('contact');

//feedback
Route::get('admin/feedback', 'FeedbackController@feedback')->name('feedback.show');
Route::post('admin/feedback', 'FeedbackController@feedbackCreate')->name('feedback.create');

Route::post('posts/{post}/comment', 'CommentsController@storeNews')->name('news.comment.create');
Route::post('news/{news}/comment', 'CommentsController@storePost')->name('post.comment.create');

//Admin
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'],function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');

    Route::get('/post', 'Admin\AdminPostController@index')->name('admin.post');
    Route::get('post/{post}/edit', 'Admin\AdminPostController@edit')->name('admin.post.edit');
    Route::patch('post/{post}', 'Admin\AdminPostController@update')->name('admin.post.update');
    Route::delete('post/{post}', 'Admin\AdminPostController@destroy')->name('admin.post.destroy');

    Route::get('/news', 'Admin\AdminNewsController@index')->name('admin.news');
    Route::get('news/{news}/edit', 'Admin\AdminNewsController@edit')->name('admin.news.edit');
    Route::patch('news/{news}', 'Admin\AdminNewsController@update')->name('admin.news.update');
    Route::delete('news/{news}', 'Admin\AdminNewsController@destroy')->name('admin.news.destroy');
});



Auth::routes();

