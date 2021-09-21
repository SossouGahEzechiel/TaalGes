<?php

use App\Http\Controllers\DemandeController;
use App\Models\Demande;
use App\Models\Service;
use App\Models\User;
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
        $data = [];
        $nb2=0;
        $nb3=0;
        $nb4=0;
        foreach ($services as $service ) {
            $nb = 0;
            foreach($service->salaries as $user){
                $nb += $user->demandes->count();
            }
            $data['service'][] = $service->lib;
            $data['nb'][] = $nb;
        }
        
        $data2 = []; //Pour receuillir les demandes en attente
        $data3 = []; //Pour receuillir les demandes accrodées 
        $data4 = []; //Pour receuillir les demandes non-accrodées
        foreach ($services as $service ) {
            $nb = 0;
            foreach($service->salaries as $user){
                $null=0;
                $acc=0;
                $ref=0;
                foreach($user->demandes as $demande){
                    if($demande->decision == null){
                        $null++;
                    }
                    if($demande->decision === 'Refusé'){
                        $ref++;
                    }
                    if($demande->decision === "Accordé"){
                        $acc++;
                    }
                }
                $nb2 += $null;
                $nb3 += $acc;
                $nb4 += $ref;
            }
            $data2['service'][] = $service->lib;
            $data4['service'][] = $service->lib;
            $data3['service'][] = $service->lib;
            $data2['nb'][] = $nb2;
            $data3['nb'][] = $nb3;
            $data4['nb'][] = $nb4;
        } 
        $data['final'] = json_encode($data);
        $data2['final'] = json_encode($data2);
        $data3['final'] = json_encode($data3);
        $data4['final'] = json_encode($data4);
        // dd($data2['final']);
        return view('stat.parService',compact('data','data2','data3','data4','last'));
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
        $data['labels'] = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
        // $data['M'] = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
        $data['M']["Janvier"] = 0;$data['M']["Fevrier"] = 0;$data['M']["Mars"] = 0;$data['M']["Avril"] = 0;$data['M'][ "Mai"] = 0;$data['M']["Juin"] = 0;
        $data['M']["Juillet"] = 0;$data['M']["Aout"] = 0;$data['M']["Septembre"] = 0;$data['M']["Octobre"] = 0;$data['M']["Novembre"] = 0;$data['M']["Decembre"] = 0;

        $data['F']["Janvier"] = 0;$data['F']["Fevrier"] = 0;$data['F']["Mars"] = 0;$data['F']["Avril"] = 0;$data['F']["Mai"] = 0;$data['F']["Juin"] = 0;
        $data['F']["Juillet"] = 0;$data['F']["Aout"] = 0;$data['F']["Septembre"] = 0;$data['F']["Octobre"] = 0;$data['F']["Novembre"] = 0;$data['F']["Decembre"] = 0;
        foreach(Demande::all() as $demande){
            if ($demande->user->sexe === 'M'){
                switch ($demande->dateDeb->month) {
                    case 1:
                        $data['M']['Janvier']++;
                        break;
                    case 2:
                        $data['M']['Fevrier']++;
                        break;
                    case 3:
                        $data['M']['Mars']++;
                        break;
                    case 4:
                        $data['M']['Avril']++;
                        break;
                    case 5:
                        $data['M']['Mai']++;
                        break;
                    case 6:
                        $data['M']['Juin']++;
                        break;
                    case 7:
                        $data['M']['Juillet']++;
                        break;
                    case 8:
                        $data['M']['Aout']++;
                        break;
                    case 9:
                        $data['M']['Septembre']++;
                        break;
                    case 10:
                        $data['M']['Octobre']++;
                        break;
                    case 11:
                        $data['M']['Novembre']++;
                        break;
                    case 12:
                        $data['M']['Decembre']++;
                        break;
                }
            } 
            else{
                switch ($demande->dateDeb->month) {
                    case 1:
                        $data['F']['Janvier']++;
                        break;
                    case 2:
                        $data['F']['Fevrier']++;
                        break;
                    case 3:
                        $data['F']['Mars']++;
                        break;
                    case 4:
                        $data['F']['Avril']++;
                        break;
                    case 5:
                        $data['F']['Mai']++;
                        break;
                    case 6:
                        $data['F']['Juin']++;
                        break;
                    case 7:
                        $data['F']['Juillet']++;
                        break;
                    case 8:
                        $data['F']['Aout']++;
                        break;
                    case 9:
                        $data['F']['Septembre']++;
                        break;
                    case 10:
                        $data['F']['Octobre']++;
                        break;
                    case 11:
                        $data['F']['Novembre']++;
                        break;
                    case 12:
                        $data['F']['Decembre']++;
                        break;
                }
            }  
        }
        $m =0;
        $f =0;
        foreach (Service::all() as $service) {
            $m = 0; $f = 0;
            foreach ($service->salaries as $user) {
                    $user->sexe==='M' ? $m++ : $f++ ;
            }
            $data['service'][] = $service->lib;
            $data['m'][] = $m;
            $data['f'][] = $f;
        }
        $data['final'] = json_encode($data);
        // dd($data['service'],$data['m'],$data['f'],);
        return view('stat.parIntervalle',compact('data'));
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