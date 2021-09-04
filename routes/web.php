<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/admin', function () {
//     return 'Vous êtes là en tant que '. Auth::user()->fonction .' bien venu';
// })->name('admin');

// Route::get('/user', function () {
//     return 'Vous êtes là en tant que '. Auth::user()->fonction .' bien venu';
// })->name('user')->middleware(['auth','user']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
Route::get('/search', 'UserController@search')->name('user.search');

Route::resource('user', 'UserController');
Route::resource('admin', 'AdminController');