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

Route::get('/create', function () {
    return view('create');
})->name('create');

Route::post('/create/submit', 'NewsController@submit')->name('create-submit');

