<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Models\Mail;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;


class MoreController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function parService()
    {
        $last = new Carbon();
        $last = Demand::all(); 
        $last = $last->last();
        $services = Service::all();
        $data = [];
        $nb2=0;
        $nb3=0;
        $nb4=0;
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
                    if($demande->decision === 'Refuse'){
                        $ref++;
                    }
                    if($demande->decision === "Accorde"){
                        $acc++;
                    }
                }
                $nb2 += $null;
                $nb3 += $acc;
                $nb4 += $ref;
            }
            $data['service'][] = $service->lib;
            $data['nb'][] = $nb2+$nb3+$nb4;
            $data['null'][] = $nb2;
            $data['acc'][] = $nb3;
            $data['ref'][] = $nb4;
        } 
        $data['final'] = json_encode($data);
        return view('stat.parService',compact('data','last'));
    }

    public function parIntervalle()
    {
        $data['labels'] = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
        $data['M']["Janvier"] = 0;$data['M']["Fevrier"] = 0;$data['M']["Mars"] = 0;$data['M']["Avril"] = 0;$data['M'][ "Mai"] = 0;$data['M']["Juin"] = 0;
        $data['M']["Juillet"] = 0;$data['M']["Aout"] = 0;$data['M']["Septembre"] = 0;$data['M']["Octobre"] = 0;$data['M']["Novembre"] = 0;$data['M']["Decembre"] = 0;

        $data['F']["Janvier"] = 0;$data['F']["Fevrier"] = 0;$data['F']["Mars"] = 0;$data['F']["Avril"] = 0;$data['F']["Mai"] = 0;$data['F']["Juin"] = 0;
        $data['F']["Juillet"] = 0;$data['F']["Aout"] = 0;$data['F']["Septembre"] = 0;$data['F']["Octobre"] = 0;$data['F']["Novembre"] = 0;$data['F']["Decembre"] = 0;
        foreach(Demand::all() as $demande){
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
        return view('stat.parIntervalle',compact('data'));
    }

    // Action pour marquer toutes notifications comme lues ☣⚡
    public function toutLire()
    {
        $notifs = DatabaseNotification::whereRead_at(null)
            ->where('notifiable_id',Auth::user()->id)->get();
        if ($notifs) {
            foreach ($notifs as $notif ) {
                $notif->update([
                    'read_at' => now()
                ]);
            }
        } else {
            return back();
        }
        return back();
    }

    public function mesMails()
    {
        $mails = Mail::whereDestinataire(Auth::user()->id)->orderByDesc('id')->simplePaginate(25);
        // dd($mails = Mail::whereDestinataire(Auth::user()->id)->count());
        return view('user.self.mesMails',compact('mails'));
    }

    public function flashMails(DatabaseNotification $notification,$id)
    {
        $notification->markAsRead();
        $notification = $notification->created_at;
        $demande = Demand::find($id);
        return view('emails.demande.avisMail',compact('demande','notification'));
    }
}