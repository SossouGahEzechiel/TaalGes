<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeRequest;
use App\Http\Requests\SearchReq;
use App\Mail\DemandeAvorteMail;
use App\Mail\DemandeSentMail;
use App\Mail\DemandeValideMail;
use App\Models\Demande;
use App\Models\User;
use App\Notifications\DemanadeSentNotification;
use App\Notifications\DemanadeValideNotification;
use App\Notifications\DemandeAvorteNotification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use MercurySeries\Flashy\Flashy;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    // use Notifiable;
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
        $demandes = Demande::simplePaginate(6);
        return view('admin.demande.index',compact('demandes'));
    }

    public function create()
    {
        $demande = new Demande;
        return view('user.demande.create',compact('demande'));
    }

    public function store(DemandeRequest $request)
    {
        //Vérifie si l'utilisateur est en mesure de faire une nouvelle demande
        if (Auth::user()->reserve > 0) {
            $demande = Demande::create([
                'typeDem'=>$request->typeDem,
                'dateDem'=>now(),
                'dateDeb'=>$request->dateDeb,
                'duree'=>$request->duree,
                'objet' => $request->objet,
                'decision' => null,
                'user_id'=> Auth::user()->id
            ]);
            Notification::send(User::whereFonction('admin')->get(),new DemanadeSentNotification($demande));
            Mail::to('taalcorp@gmail.com')->send(new DemandeSentMail($demande,Auth::user()));
            Flashy::success("Votre demande a été envoyée avec succès");
            return redirect(route('user.show',$demande->user->id));
        }
        // Auth::user()->notify(new DemandeAvorteNotification(Auth::user(),$request));
        Mail::to(Auth::user()->email)->send(new DemandeAvorteMail(Auth::user()));
        Flashy::error("Un problème s'est posé avec votre demande");
        return back();
        // Auth::user()->notify(new DemandeAvorteNotification()); À complèter 
    }

    public function show(Demande $demande)
    {
        // $demande->markAsRead();
        return view('admin.demande.show',compact('demande'));
    }

    public function edit(Demande $dem)
    {
        return view('demande.edit',compact('dem'));
    }

    public function update(Demande $demande)
    {
        $demande->update([
            'decision' => 'Accordé'
        ]);
        $user = User::whereId($demande->user_id)->first();
        $user->update([
            'reserve' => $user->reserve -= $demande->duree
        ]);
        $user->notify(new DemanadeValideNotification($demande,$user));
        Mail::to($user->email)->send(new DemandeValideMail($demande,$user));
        Flashy::success('Acceptation de demande confirmé');
        return back();
    }

    public function destroy(Demande $dem)
    {
        $dem->delete();
        Flashy::danger('Demande supprimée avec succès');
        return redirect(route('demande.index'));
    }

    public function attente()
    {
        $demandes = Demande::whereDecision(null)->simplePaginate(6);
        return view('admin.demande.etat',compact('demandes'));
    }
    
    //Mes actions
    public function refuse()
    {
        $demandes = Demande::whereDecision('Refusé')->simplePaginate(6);
        return view('admin.demande.etat',compact('demandes'));
    }
    
    public function accorde()
    {
        $demandes = Demande::whereDecision('Accordé')->simplePaginate(6);
        return view('admin.demande.etat',compact('demandes'));
    }

    public function search(SearchReq $request)
    {
        $demandes = Demande::whereRelation('user','nom','like',"%$request->search%")->get();
        return view('admin.demande.serach',compact('demandes','request'));
    }

    public function read(DatabaseNotification $notification,$id)
    {
        $notification->markAsRead();
        return redirect(route('demande.show',$id));
    }
}