<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave;
use App\Models\Demand;
use App\Models\Permission;
use App\Mail\DemandeSentMail;
use App\Mail\DemandeAvorteMail;
use App\Mail\DemandeValideMail;
use App\Http\Requests\SearchReq;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\DemandeRequest;
use App\Notifications\AvisNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DemanadeSentNotification;
use App\Notifications\DemanadeValideNotification;
use Illuminate\Notifications\DatabaseNotification;

class DemandeController extends Controller
{
    // use Notifiable;
    public function __construct() {
        $this->middleware(['auth']);
        // $this->middleware(['auth','user'])->only(['create','store']);
        // $this->middleware(['auth','admin'])->only([
        //     'index','validation','search','attente','accorde','refuse'
        // ]);

    }
    public function index()
    {
        $total = Demand::all()->count();
        $demandes = Demand::orderByDesc('id')->simplePaginate(15);
        return view('admin.demande.index',compact('demandes','total'));
    }

    public function create()
    {
        $demande = new Demand;
        return view('user.demande.create',compact('demande'));
    }

    public function store(DemandeRequest $request)
    {
        if (Auth::user()->reserve > 0) {
            $Demand = Demand::create([
                'type_demande_id'=>$request->typeDem,
                'dateDem'=>now(),
                'dateDeb'=>$request->dateDeb,
                'duree'=>$request->duree,
                'decision' => null,
                'user_id'=> Auth::user()->id
            ]);
            if ($request->typeDem == 1) {
                Leave::create([
                    'demand_id' =>$Demand->id
                ]);
            } else {
                Permission::create([
                    'objet' =>$request->objet,
                    'demand_id' =>$Demand->id
                ]);
            }
            
            
            Notification::send(User::whereFonction('admin')->get(),new DemanadeSentNotification($Demand));
            Mail::to('taalsa@gmail.com')->send(new DemandeSentMail($Demand,Auth::user()));
            Flashy::success("Votre demande a été envoyée avec succès");
            return redirect(route('user.show',$Demand->user->id));
        }
        
        Mail::to(Auth::user()->email)->send(new DemandeAvorteMail(Auth::user()));
        Flashy::error("Un problème s'est posé avec votre Demand");
        return back();
        // Auth::user()->notify(new DemandAvorteNotificatçion()); À complèter 
    }

    public function show(Demand $demande)
    {
        return view('admin.demande.show',compact('demande'));
    }

    public function edit(Demand $Demand)
    {
        //
    }

    public function update(Demand $demande)
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

    public function destroy(Demand $demande)
    {
        $demande->delete();
        Flashy::error('Demande supprimée avec succès');
        return redirect(route('demande.index'));
    }

    //Mes actions
    public function attente()
    {
        $Demands = Demand::whereDecision(null)->simplePaginate(15);
        $total = Demand::whereDecision(null)->count();
        return view('admin.demande.etat',compact('Demands','total'));
    }
    
    public function refuse()
    {
        $Demands = Demand::whereDecision('Refusé')->simplePaginate(15);
        $total = Demand::whereDecision('Refusé')->count();
        return view('admin.demande.etat',compact('Demands','total'));
    }
    
    public function accorde()
    {
        $Demands = Demand::whereDecision('Accordé')->simplePaginate(15);
        $total = Demand::whereDecision('Accordé')->count();
        return view('admin.demande.etat',compact('Demands','total'));
    }

    public function search(SearchReq $request)
    {
        $Demands = Demand::with('user')->whereRelation('user','nom','like',"%$request->search%")->get();
        return view('admin.demande.serach',compact('Demands','request'));
    }

    public function validation(Demand $demande, $decision, $opt = null)
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
        } 
        $user = User::find($demande->user_id);
        $user->notify(new DemanadeValideNotification($demande));
        Mail::to($user->email)->send(new DemandeValideMail($demande,$user));
        Notification::send(
            User::where('id','!=',$demande->user_id)->get(),
            new AvisNotification($demande)
        );
        Flashy::success('Décision appliquée à la demande avec succès');
        return back();
    }

    public function today()
    {
        $demandes = [];
        foreach (Demand::orderByDesc('dateDem')->get() as $demand) {
            if($demand->dateDem->isToday())
                $demandes[] = $demand;
        }
        $total = sizeof($demandes);
        return view('admin.demande.by',compact('demandes','total'));
    }

    public function thisWeek()
    {
        $demandes = [];
        foreach (Demand::orderByDesc('dateDem')->get() as $demande) {
            if($demande->dateDem->isCurrentWeek())
                $demandes[] = $demande;
        }
        $total = sizeof($demandes);
        return view('admin.demande.by',compact('demandes','total'));
    }

    public function thisMonth()
    {
        $demandes = [];
        foreach (Demand::orderByDesc('dateDem')->get() as $demande) {
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