<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalarierReqForm;
use App\Http\Requests\SalarierReqFormPrime;
use App\Models\Civilite;
use App\Models\Fonction;
use App\Models\Salarie;
use App\Models\Service;
use MercurySeries\Flashy\Flashy;

class SalarieController extends Controller
{

    public function index()
    {
        $sal = Salarie::simplePaginate(7);
        return view('salarie.index',compact('sal'));
    }

    public function create()
    {
        $service = Service::all();
        return view('salarie.create',compact('sal','fonc','service','civ'));
    }

    public function store(SalarierReqForm $request)
    {   
        
        $sal = Salarie::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'adresse'=>$request->adresse,
            'tel'=>$request->telephone,
            'dateEmb'=>$request->dateEmbauche,
            'natCont'=>$request->natCont,
            'fonction_id'=>$request->fonction,
            'service_id'=>$request->service,
            'civilite_id'=>$request->civilite            
        ]);
        Flashy::success(sprintf("%s %s %s avec succès",$sal->civilite->libCiv,$sal->nom,ajout($sal)));
        return redirect(route('sal.show',$sal));
    }

    public function show(Salarie $sal)
    {  
        // $dem = DB::table('permissions')
        //     ->join('demandes','permissions.id','=','demandes.id')->get(['permissions.objet as perOb']);
        // $dem = $sal->demandes;
        // foreach ($dem as $dem) {
            // $perm = Permission::whereDemande_id($dem->id)->get();
        //     foreach ($perm as $perm) {
        //         dump($perm->objet);
        //     }
        // }
        // foreach ($dem as $dem) {
        // $perm = Permission::whereDemande_id($dem->id)->get();
        //         dump($perm->objet);
        // }
        // $perm = Permission::whereDemande_id($dem)->get();
        // $dem = SalarieDB::select('select * from users where active = ?', [1])
        // $dem = Demande::whereSalarie_id($sal->id)->get();
        // $perm = $perm->permission;   
        // dd($perm);
        // dd($perm->objet);
        // foreach ($perm as $perm ) {
        //     dump($perm->objet);
        // }
        // die();
        return view('salarie.show',compact('sal'));
    }

    public function edit(Salarie $sal)
    {
        $fonc = Fonction::all();
        $service = Service::all();
        $civ = Civilite::all();
        return view('salarie.edit',compact('sal','fonc','service','civ'));
    }

    public function update(SalarierReqFormPrime $request, Salarie $sal)
    {
        $sal->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'adresse'=>$request->adresse,
            'tel'=>$request->telephone,
            'dateEmb'=>$request->dateEmbauche,
            'natCont'=>$request->natCont,
            'fonction_id'=>$request->fonction,
            'service_id'=>$request->service,
            'civilite_id'=>$request->civilite            
        ]);
        Flashy::success('Modifications appliquées avec succès');
        return redirect(route('sal.show',$sal));
    }

    public function destroy(Salarie $sal)
    {
        function retire($sal)
        {
            if ($sal->civilite->libCiv == "Monsieur") {
                return "retiré";
            } else {
                return "retirée";
            }
        }
        $sal->delete();
        Flashy::warning(sprintf("%s %s %s avec succès",$sal->civilite->libCiv,$sal->nom,retire($sal)));
        return redirect(route('sal.index'));
    }
}
