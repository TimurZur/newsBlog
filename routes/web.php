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

Route::get('/', 'NewsController@allData')->name('home');
//Route::get('/?sort={sortType}', 'NewsController@allData')->name('home-sort');

Route::get('/create', function () {
    return view('create');
})->name('create');

Route::post('/create/submit', 'NewsController@submit')->name('create-submit');

Route::get('/{id}', 'NewsController@showOneNews')->name('one-news');
Route::get('/{id}/edit', 'NewsController@editNews')->name('news-edit');
Route::post('/{id}/edit', 'NewsController@editNewsSubmit')->name('news-edit-submit');
Route::get('/{id}/delete', 'NewsController@deleteNews')->name('news-delete');

Route::post('/like/{id}', 'NewsController@likeNews')->name('news-like');
Route::get('/like/{id}', 'NewsController@getLikes')->name('news-like-get');


