<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use App\Mail\DemandeSentMail;
use App\Mail\DemandeValideMail;
use App\Mail\DemandeAvorteMail;
use App\Http\Requests\SearchReq;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\DemandeRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DemanadeSentNotification;
use App\Notifications\DemanadeValideNotification;
use Illuminate\Notifications\DatabaseNotification;

class DemandeController extends Controller
{
    // use Notifiable;
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
        $total = Demande::all()->count();
        $demandes = Demande::orderByDesc('id')->simplePaginate(15);
        return view('admin.demande.index',compact('demandes','total'));
    }

    public function create()
    {
        $demande = new Demande;
        return view('user.demande.create',compact('demande'));
    }

    public function store(DemandeRequest $request)
    {
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
            Mail::to('taalsa@gmail.com')->send(new DemandeSentMail($demande,Auth::user()));
            Flashy::success("Votre demande a été envoyée avec succès");
            return redirect(route('user.show',$demande->user->id));
        }
        
        Mail::to(Auth::user()->email)->send(new DemandeAvorteMail(Auth::user()));
        Flashy::error("Un problème s'est posé avec votre demande");
        return back();
        // Auth::user()->notify(new DemandeAvorteNotificatçion()); À complèter 
    }

    public function show(Demande $demande)
    {
        return view('admin.demande.show',compact('demande'));
    }

    public function edit(Demande $demande)
    {
        //
    }

    public function update(Demande $demande)
    {
        $demande->update([
            'decision' => 'Refuse',
            'v_at' => now(),
            'v_by' => Auth::user()->id
        ]);
        $user = User::whereId($demande->user_id)->first();
        $user->notify(new DemanadeValideNotification($demande,$user));
        Mail::to($user->email)->send(new DemandeValideMail($demande,$user));
        Flashy::success('Rejet de demande confirmé');
        return back();
    }

    public function destroy(Demande $demande)
    {
        $demande->delete();
        Flashy::error('Demande supprimée avec succès');
        return redirect(route('demande.index'));
    }

    //Mes actions
    public function attente()
    {
        $demandes = Demande::whereDecision(null)->simplePaginate(15);
        $total = Demande::whereDecision(null)->count();
        return view('admin.demande.etat',compact('demandes','total'));
    }
    
    public function refuse()
    {
        $demandes = Demande::whereDecision('Refusé')->simplePaginate(15);
        $total = Demande::whereDecision('Refusé')->count();
        return view('admin.demande.etat',compact('demandes','total'));
    }
    
    public function accorde()
    {
        $demandes = Demande::whereDecision('Accordé')->simplePaginate(15);
        $total = Demande::whereDecision('Accordé')->count();
        return view('admin.demande.etat',compact('demandes','total'));
    }

    public function search(SearchReq $request)
    {
        $demandes = Demande::with('user')->whereRelation('user','nom','like',"%$request->search%")->get();
        return view('admin.demande.serach',compact('demandes','request'));
    }

    public function validation(Demande $demande, $decision, $opt = null)
    {
        if($decision){
            $demande->update([
                'decision' => 'Accorde',
                'v_at' => now(),
                'v_by' => Auth::user()->id
            ]);
            
            if ($opt) {
                $user = User::whereId($demande->user_id)->first();
                $user->update([
                    'reserve' => $user->reserve -= $demande->duree
                ]);
            }
        } else {
            $demande->update([
                'decision' => 'Refuse',
                'v_at' => now(),
                'v_by' => Auth::user()->id
            ]);
        }
        $user = User::whereId($demande->user_id)->first();
        Notification::send(
            User::where('id','!=',$demande->user_id)->get(),
            new DemanadeValideNotification($demande)
        ); //Créer une nouvelle notification pour ce cas
        $user->notify(new DemanadeValideNotification($demande));
        Mail::to($demande->user->email)->send(new DemandeValideMail($demande,$user));
        Flashy::success('Décision appliquée à la demande avec succès');
        return back();
    }

    public function today()
    {
        $all = Demande::all();
        $demandes = [];
        foreach ($all as $demande) {
            if($demande->dateDem->isToday())
                $demandes[] = $demande;
        }
        $total = sizeof($demandes);
        return view('admin.demande.by',compact('demandes','total'));
    }

    public function thisWeek()
    {
        $all = Demande::all();
        $demandes = [];
        foreach ($all as $demande) {
            if($demande->dateDem->isCurrentWeek())
                $demandes[] = $demande;
        }
        $total = sizeof($demandes);
        return view('admin.demande.by',compact('demandes','total'));
    }

    public function thisMonth()
    {
        $all = Demande::all();
        $demandes = [];
        foreach ($all as $demande) {
            if($demande->dateDem->isCurrentMonth())
                $demandes[] = $demande;
        }
        $total = sizeof($demandes);
        return view('admin.demande.by',compact('demandes','total'));
    }

    public function aMonth(int $month)
    {
        # code...
    }

    public function read(DatabaseNotification $notification,int $id)
    {
        $notification->markAsRead();
        return redirect(route('demande.show',$id));
    }

}