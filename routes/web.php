<?php

use App\Http\Controllers\DemandeController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
Route::get('/user_search', 'UserController@search')->name('user.search');
Route::get('/service_search', 'ServiceController@search')->name('service.search');
Route::get('/mesdemandes', 'UserController@profil')->name('user.profil')->middleware(['auth','user']);

Route::resource('user', 'UserController');
Route::resource('admin', 'AdminController');
Route::resource('service', 'ServiceController');
Route::resource('demande', 'DemandeController');