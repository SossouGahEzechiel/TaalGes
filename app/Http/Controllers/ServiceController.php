<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceReq;
use App\Models\Service;
use MercurySeries\Flashy\Flashy;

class ServiceController extends Controller
{

    public function index()
    {
        $serv = Service::all();
        return view('service.index',compact('serv'));
    }

    public function create()
    {
        $serv = new Service;
        return view('service.create',compact('serv'));
    }

    public function store(ServiceReq $request)
    {
        $serv = Service::create([
            'libServ'=>$request->lib
        ]);
        Flashy::success(sprintf('Service %s créé avec succes',$serv->libServ));
        return redirect(route('serv.show',$serv));
    }

    public function show(Service $serv)
    {
        return view('service.show',compact('serv'));
    }

    public function edit(Service $serv)
    {
        return view('service.edit',compact('serv'));
    }

    public function update(ServiceReq $request, Service $serv)
    {
        $serv->update([
            'libServ'=>$request->lib
        ]);
        Flashy::success(sprintf('Serve %s mis à jour avec succes',$serv->libServ));
        return redirect(route('serv.show',$serv));
    }

    public function destroy(Service $serv)
    {
        $serv->delete();
        Flashy::warning(sprintf('Serve %s supprimé avec succes',$serv->libServ));
        return redirect(route('serv.index'));
    }
}