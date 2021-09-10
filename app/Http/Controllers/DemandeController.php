<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeRequest;
use App\Http\Requests\SearchReq;
use App\Models\Demande;
use App\Models\User;
use App\Notifications\DemanadeSentNotification;
use App\Notifications\DemanadeValideNotification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use MercurySeries\Flashy\Flashy;

class DemandeController extends Controller
{
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
        $demande = Demande::create([
            'typeDem'=>$request->typeDem,
            'dateDem'=>now(),
            'dateDeb'=>$request->dateDeb,
            'duree'=>$request->duree,
            'objet' => $request->objet,
            'decision' => 'Refusé',
            'user_id'=> Auth::user()->id
        ]);
        Notification::send(User::whereFonction('admin')->get(),new DemanadeSentNotification($demande));
        // $demande->user->notify(new DemanadeSentNotification($demande));
        // Mail::to('taalcorp@gmail.com')->send(new DemandeSentMail($demande));
        Flashy::success("Votre demande a été envoyé avec succès");
        return redirect(route('user.show',$demande->user->id));
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
        // Mail::to($user->email)->send(new DemandeValideMail($demande,$user));
        Flashy::success('Acceptation de demande confirmé');
        return redirect(route('demande.index'));
    }

    public function destroy(Demande $dem)
    {
        $dem->delete();
        Flashy::danger('Demande supprimée avec succès');
        return redirect(route('dem.index'));
    }

    public function attente()
    {
        $demandes = Demande::whereDecision('')->simplePaginate(6);
        return view('admin.demande.attente',compact('demandes'));
    }
    
    //Mes actions
    public function refuse()
    {
        $demandes = Demande::whereDecision('Refusé')->simplePaginate(6);
        return view('admin.demande.attente',compact('demandes'));
    }
    
    public function accorde()
    {
        $demandes = Demande::whereDecision('Accordé')->simplePaginate(6);
        return view('admin.demande.attente',compact('demandes'));
    }

    public function search(SearchReq $request)
    {
        $demandes = Demande::whereRelation('user','nom','like',"%$request->search%")->get();
        return view('admin.demande.serach',compact('demandes','request'));
    }

    public function read(DatabaseNotification $notification,$id)
    {
        // dump(DatabaseNotification::all(),$id,$notification->read_at);
        // dump($notif = DatabaseNotification::whereRead_at($notification->read_at)->first());
        $notification->markAsRead();
        // dump($notification->read_at);
        // dd($notif = DatabaseNotification::whereRead_at($notification->read_at)->get('read_at'));
        return redirect(route('demande.show',$id));
    }
}