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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('posts', 'PostsController');
    Route::resource('tags', 'TagsController');
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts');
    Route::put('restore-posts/{post}', 'PostsController@restore')->name('restore-posts');

    Route::get('users', 'UsersController@index')->name('users')->middleware(['admin']);
    Route::get('users/edit', 'UsersController@edit')->name('users.edit');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('make-admin')->middleware(['admin']);
    Route::put('users/update', 'UsersController@update')->name('users.update');
});
