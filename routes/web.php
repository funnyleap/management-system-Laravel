<?php

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
    return view('home');
})->middleware('auth');

// ログイン
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Admin
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    // USER
    Route::post('/api/admin/user', 'UserController@index')->name('admin/user');
});

// other
Route::get('/{any}', function () {
    return view('home');
})->middleware('auth')->where('any', '.*');
