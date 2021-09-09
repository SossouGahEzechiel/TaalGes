<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeRequest;
use App\Http\Requests\SearchReq;
use App\Mail\DemandeSentMail;
use App\Mail\DemandeValideMail;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        
        Mail::to('taalcorp@gmail.com')->send(new DemandeSentMail($demande));
        Flashy::success("Votre demande a été envoyé avec succès");
        return redirect(route('demande.show',$demande->id));
    }

    public function show(Demande $demande)
    {
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
        // dd($user->email);
        // Mail::to($user->['email'])->send(new DemandeValideMail($demande,$user));
        Mail::to($user->email)->send(new DemandeValideMail($demande,$user));
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
}