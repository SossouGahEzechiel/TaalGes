<?php

namespace App\Http\Controllers;

use App\Http\Requests\FonctionReqForm;
use App\Http\Requests\FonctionReqFormPrime;
use App\Models\Fonction;
use MercurySeries\Flashy\Flashy;

class FonctionController extends Controller
{

    public function index()
    {
        $fonc = Fonction::simplePaginate(10);
        return view('fonction.index',compact('fonc'));
    }

    public function create()
    {
        $fonc = new Fonction;
        return view('fonction.create',compact('fonc'));
    }

    public function store(FonctionReqForm $request)
    {
        Fonction::create([
            'libFonc'=>$request->LibelleDeLaFonction
        ]);
        return redirect(route('fonc.index'));
    }

    public function show(Fonction $fonc)
    {
        return view('fonction.show',compact('fonc'));
    }

    public function edit(Fonction $fonc)
    {
        return view('fonction.edit',compact('fonc'));
    }

    public function update(FonctionReqFormPrime $request, Fonction $fonc)
    {
        $fonc->update([
            'libFonc'=>$request->LibelleDeLaFonction
        ]);
        Flashy::success('Modifications appliquées avec succès');
        return redirect(route('fonc.show',$fonc));
    }

    public function destroy(Fonction $fonc)
    {
        $fonc->delete();
        Flashy::warning(sprintf("Fonction %s supprimée avec succès",$fonc->libFonc));
        return redirect(route('fonc.index'));
    }
}
