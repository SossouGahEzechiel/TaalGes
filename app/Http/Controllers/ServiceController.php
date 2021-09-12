<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchReq;
use App\Http\Requests\ServiceReq;
use App\Models\Service;
use App\Models\User;
use MercurySeries\Flashy\Flashy;

class ServiceController extends Controller
{

    public function __construct() {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $services = Service::simplePaginate(5);
        return view('admin.service.index',compact('services'));
    }

    public function create()
    {
        $admins = User::whereFonction('admin')->get();
        $service = new Service;
        return view('admin.service.create',compact('service','admins'));
    }

    public function store(ServiceReq $request)
    {
        $service = Service::create([
            'lib'=>$request->lib,
            'directeur_id'=>$request->boss
        ]);
        Flashy::success(sprintf('Service %s créé avec succes',$service->lib));
        return redirect(route('service.index',$service));
    }

    public function show(Service $service)
    {
        $admins = User::whereFonction('admin')->get();
        return view('admin.service.show',compact('service','admins'));
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit',compact('service'));
    }

    public function update(ServiceReq $request, Service $service)
    {
        $service->update([
            'lib'=>$request->lib
        ]);
        Flashy::success(sprintf('service %s mis à jour avec succes',$service->lib));
        return redirect(route('service.show',$service));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        Flashy::warning(sprintf('service %s supprimé avec succes',$service->lib));
        return redirect(route('service.index'));
    }

    public function search(SearchReq $request)
    {
        $services = Service::where('lib','like',"%$request->search%")->get();
        return view('admin.service.search',compact('services','request'));
    }
}