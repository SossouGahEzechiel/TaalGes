<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceReq;
use App\Models\Service;
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
        $service = new Service;
        return view('admin.service.create',compact('service'));
    }

    public function store(ServiceReq $request)
    {
        $service = Service::create([
            'lib'=>$request->lib
        ]);
        Flashy::success(sprintf('Service %s créé avec succes',$service->lib));
        return redirect(route('service.index',$service));
    }

    public function show(Service $service)
    {
        return view('admin.service.show',compact('service'));
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
}