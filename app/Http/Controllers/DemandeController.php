<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeRequest;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class DemandeController extends Controller
{
    public function index()
    {
        $dem = Demande::simplePaginate(10);
        return view('demande.index',compact('dem'));
    }

    public function create()
    {
        $dem = new Demande;
        return view('demande.create',compact('dem'));
    }

    public function store(DemandeRequest $request)
    {   
        $dem = Demande::create([
            'typeDem'=>$request->type,
            'dateDem'=>now(),
            'dateDeb'=>$request->dateDeb,
            'duree'=>$request->duree,
            'objet' => $request->objet,
            'user_id'=> Auth::user()->id
        ]);

        Flashy::success("Votre demande a été envoyé avec succès");
        return redirect(route('demande.show',$dem->id));
    }

    public function show(Demande $dem)
    {
        return view('demande.show',compact('dem'));
    }

    public function edit(Demande $dem)
    {
        return view('demande.edit',compact('dem'));
    }

    public function update(DemandeRequest $request, Demande $dem)
    {
        $dem->update([
            'typeDem'=>$request->type,
            'dateDem'=>now(),
            'dateDeb'=>$request->dateDeb,
            'duree'=>$request->duree,
            'objet' => $request->objet,
            'user_id'=> Auth::user()->id
        ]);
        Flashy::success('Demande mise à jour avec succès');
        return redirect(route('dem.show',$dem->id));
    }

    public function destroy(Demande $dem)
    {
        $dem->delete();
        Flashy::danger('Demande supprimée avec succès');
        return redirect(route('dem.index'));
    }
}
