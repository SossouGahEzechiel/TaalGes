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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Route de déconnexion
Route::get('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

//Route de recherche
Route::get('/user_search', 'UserController@search')->name('user.search')->middleware(['auth','admin']); //Route de recherche des utlisateurs
Route::get('/service_search', 'ServiceController@search')->name('service.search'); //Route de recherche d'un service
Route::get('/demande/search', 'DemandeController@search')->name('demande.search'); //Route de recherche de l'auteur d'une demande

//Route de test des mails
Route::get('/user_mail', 'UserController@mail')->name('user.mail')->middleware(['auth','user']);

//Routes de gestion des demandes
Route::get('/demande/en_attente', 'DemandeController@attente')->name('demande.attente')->middleware(['auth','admin']); //Afficher les demandes en attente
Route::get('/demande/accorde', 'DemandeController@accorde')->name('demande.accorde')->middleware(['auth','admin']); //Afficher les demandes accordées
Route::get('/demande/refuse', 'DemandeController@refuse')->name('demande.refuse')->middleware(['auth','admin']); //Afficher les demandes non-accordées
Route::put('/demande/{demande}/{decision}/{opt?}', 'DemandeController@validation')->name('demande.validation')->middleware(['auth','admin']); //Afficher les demandes non-accordées

//Par rapport aux notifications 
Route::get('/demande/read/{notification}/{id}', 'DemandeController@read')->name('demande.read')->middleware(['auth']); //Marquer une notification comme lue

// Route de consultation de ses demandes
Route::get('/mesdemandes', 'UserController@profil')->name('user.profil')->middleware(['auth']);

// Mes resources
Route::resource('user', 'UserController');
Route::resource('admin', 'AdminController');
Route::resource('service', 'ServiceController');
Route::resource('demande', 'DemandeController');


// Les routes pour les statistiques
Route::middleware(['auth','admin'])->prefix('/stat')->group(function () {

    Route::get('/par-service','MoreController@parService')->name('stat.parService');
    Route::get('/par-intervalle', 'MoreController@parIntervalle')->name('stat.parIntervalle');
    
});

// Route pour marquer toutes notifications comme lues ☣⚡
Route::get('/toutLire', 'MoreController@toutLire')->name('toutLire');

// Routes pour cinder les demandes sur un petit intervalle de temps et pour gérer les mails
Route::middleware(['auth','admin'])->group(function () {
    
    Route::get('/today', 'DemandeController@today')->name('byTime.today');
    Route::get('/this-week', 'DemandeController@today')->name('byTime.week');
    Route::get('/this-month', 'DemandeController@today')->name('byTime.month');
    Route::get('/mails', 'MoreController@mail')->name('mails');

});