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
//Route de recherche
Route::get('/user_search', 'UserController@search')->name('user.search')->middleware(['auth','admin']); //Route de recherche des utlisateurs
Route::get('/service_search', 'ServiceController@search')->name('service.search'); //Route de recherche d'un service
Route::get('/demande/search', 'DemandeController@search')->name('demande.search'); //Route de recherche de l'auteur d'une demande

Route::get('/user_mail', 'UserController@mail')->name('user.mail')->middleware(['auth','user']);

Route::get('/demande/en_attente', 'DemandeController@attente')->name('demande.attente')->middleware(['auth','admin']);
Route::get('/demande/accorde', 'DemandeController@accorde')->name('demande.accorde')->middleware(['auth','admin']);
Route::get('/demande/refuse', 'DemandeController@refuse')->name('demande.refuse')->middleware(['auth','admin']);

Route::get('/mesdemandes', 'UserController@profil')->name('user.profil')->middleware(['auth']);

Route::resource('user', 'UserController');
Route::resource('admin', 'AdminController');
Route::resource('service', 'ServiceController');
Route::resource('demande', 'DemandeController');