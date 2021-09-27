<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchReq;
use App\Http\Requests\ServiceReq;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MercurySeries\Flashy\Flashy;

class ServiceController extends Controller
{
    public $old;

    public function __construct() {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
    
        $services = Service::simplePaginate(10);
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
            'directeur_id'=>$request->directeur_id
        ]);
        $admin = User::whereId($service->directeur_id)->first();
        $admin->update([
            'service_id'=>$service->id
        ]);
        Flashy::success(sprintf('Service %s créé avec succes',$service->lib));
        return redirect(route('service.index',$service));
    }

    public function show(Service $service)
    {
        return view('admin.service.show',compact('service'));
    }

    public function edit(Service $service)
    {   $admins = User::whereFonction('admin')->get();
        return view('admin.service.edit',compact('service','admins'));
    }

    public function update(Request $request ,Service $service)
    {
        $request->validate([
            'lib' => ['required','min:3','max:35',Rule::unique('services')->ignore($service->id)],
            'directeur_id' => ['required',Rule::unique('services')->ignore($service->id)]
        ]);
        $service->update([
            'lib'=>$request->lib,
            'directeur_id' =>$request->directeur_id
        ]);
        $admin = User::whereId($service->directeur_id)->first();
        $admin->update([
            'service_id'=>$service->id
        ]);
        Flashy::success(sprintf('Modification appliquée avec succes'));
        return redirect(route('service.show',$service));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        Flashy::success(sprintf('service %s supprimé avec succes',$service->lib));
        return redirect(route('service.index'));
    }

    public function search(SearchReq $request)
    {
        $services = Service::where('lib','like',"%$request->search%")->get();
        return view('admin.service.search',compact('services','request'));
    }
}