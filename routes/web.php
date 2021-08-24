<?php

use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'FonctionController@index');
Route::resource('fonc', 'FonctionController');
Route::resource('sal', 'SalarieController');
Route::resource('dem', 'DemandeController');
Route::resource('serv', 'ServiceController');
Route::resource('other', 'OtherController');
Route::get('other', function () {
    return view('other.layout.obase');
})->name('other');
Route::get('index', 'OtherController@index')->name('other.index');