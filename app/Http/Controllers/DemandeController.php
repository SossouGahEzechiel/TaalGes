<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeRequest;
use App\Models\Conge;
use App\Models\Demande;
use App\Models\Fonction;
use App\Models\Permission;
use App\Models\Salarie;
use MercurySeries\Flashy\Flashy;

class DemandeController extends Controller
{
    public function index()
    {
        $dem = Demande::all();
        return view('demande.index',compact('dem'));
    }

    public function create()
    {
        $dem = new Demande;
        $sal = Salarie::all();
        return view('demande.create',compact('dem','sal'));
    }

    public function store(DemandeRequest $request)
    {   
        $dem = Demande::create([
            'dateDem'=>now(),
            'dateDeb'=>$request->dateDeb,
            'nbrJours'=>$request->dure,
            'demandeable_type'=>DemandeController::type($request),
            'demandeable_id'=>DemandeController::getId($request),
            'salarie_id'=>$request->auteur
        ]);
        return redirect(route('dem.show',$dem->id));
    }

    public function show(Demande $dem)
    {
        $cong = Conge::all()->find($dem->demandeable_id);
        $perm = Permission::all()->find($dem->demandeable_id);
        $infoSal = Fonction::all()->find($dem->salarie->fonction_id);
        return view('demande.show',compact('dem','infoSal','cong','perm'));
    }

    public function edit(Demande $dem)
    {
        $sal = Salarie::all();
        return view('demande.edit',compact('dem','sal'));
    }

    public function update(DemandeRequest $request, Demande $dem)
    {
        $dem->update([
            'dateDem'=>now(),
            'dateDeb'=>$request->dateDeb,
            'nbrJours'=>$request->dure,
            'demandeable_type'=>DemandeController::type($request),
            'demandeable_id'=>DemandeController::getId($request),
            'salarie_id'=>$request->auteur
        ]);
        Flashy::success('Demande mise à jour avec succès');
        return redirect(route('dem.show',$dem->id));
    }

    public function destroy(Demande $dem)
    {
        function delPerm($dem)
        {
            if ($dem->demandeable_type == "App\Models\Permission") {
                $perm = Permission::all()->find($dem->demandeable_id);
                $perm->delete();
            }
        }
        
        function delConge($dem)
        {
            if ($dem->demandeable_type == "App\Models\Conge") {
                $cong = Conge::all()->find($dem->demandeable_id);
                $cong->delete();
            }
        }
        $dem->delete();
        Flashy::warning('Demande supprimée avec succès');
        return redirect(route('dem.index'));
    }
    static function type($request)
    {
        if( $request->typeDem == 'conge'){
            Conge::create([
                'etatConge'=>'refusé'
            ]);
            return 'App\Models\Conge';
        }
        if( $request->typeDem == 'permission'){
            Permission::create([
                'type_permission_id'=>1,
                'objet'=>$request->objet,
                'decision'=>'refusé',
            ]);
            return 'App\Models\Permission';
        } 
    }
    static function getId($request)
    {
        if( $request->typeDem == 'conge'){
            $id = Conge::max('id');
            return $id;
        }
        if( $request->typeDem == 'permission'){
            $id = Permission::max('id');
            return $id;
        } 
    }
}
