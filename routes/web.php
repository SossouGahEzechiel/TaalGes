<?php

use App\Http\Controllers\DemandeController;
use App\Models\Demande;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;
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
Route::get('/demande/read/{notification}/{id}', 'DemandeController@read')->name('demande.read')->middleware(['auth']); //Marquer une notification comme lue

// Route de consultation de ses demandes
Route::get('/mesdemandes', 'UserController@profil')->name('user.profil')->middleware(['auth']);

// Mes resources
Route::resource('user', 'UserController');
Route::resource('admin', 'AdminController');
Route::resource('service', 'ServiceController');
Route::resource('demande', 'DemandeController');

Route::middleware(['auth','admin'])->prefix('/stat')->group(function () {
    // Route::post('/stat/a_venir','StatController@futur')->name('stat.futur.response');
    Route::get('/par-service',function(){
        $last = new Carbon();
        $last = Demande::all(); 
        $last = $last->last();
        $services = Service::all();
        $nb = 0;
        $data = [];
        foreach ($services as $service ) {
            $nb = 0;
            foreach($service->salaries as $user){
                $nb += $user->demandes->count();
            }
            $data['service'][] = $service->lib;
            $data['nb'][] = $nb;
        }
        $data['final'] = json_encode($data);
        return view('stat.parService',compact('data','last'));
        // dump($data['final'] = json_encode($data));
        // $demandes = Demande::all()->groupBy('user_id');
        // // dd($demandes);
        // foreach ($demandes as $demande) {
        //     // echo $demandes;
        //     foreach ($demande as $dem ) {
        //         dump($dem->user->service->lib,$dem->user->nom,);
        //     }
        // }
        // foreach ($services as $service) {
        //     foreach($service->salaries as $user){
        //         dump($user->demandes->count().' demandes addressées par '.$user->nom.' étant sous les ordres de '.$service->boss()->nom.' '.$service->lib);
        //         foreach($user->demandes as $demande){
        //             dump($demande->dateDeb->month.' de '.$user->nom.' du service de: '.$user->service->boss()->nom.' chef de: '.$service->lib);
        //         }
        //     }
        // }
        // die();
    })->name('stat.parService');
    Route::get('/par-intervalle', function(){

    })->name('stat.parIntervalle');
});

// Route pour marquer toutes notifications comme lues ☣⚡
// Route::get('/toutLire', function(){
//     $notifs = DatabaseNotification::whereRead_at(null)->get();
//     foreach ($notifs as $notif ) {
//         $notif->update([
//             'read_at'=>now()
//         ]);
//     }
//     return "ok C'set bon";
// })->name('toutLire');