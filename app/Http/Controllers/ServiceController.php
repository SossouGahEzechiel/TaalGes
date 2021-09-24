<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchReq;
use App\Http\Requests\ServiceReq;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Validation\Rule;
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
        // dd($admin);
        return view('admin.service.show',compact('service'));
    }

    public function edit(Service $service)
    {   $admins = User::whereFonction('admin')->get();
        // dd(User::all());
        return view('admin.service.edit',compact('service','admins'));
    }

    public function update(Request $request ,Service $service)
    {
        $request->validate([
            $request->lib => ['required','min:5','max:35',Rule::unique('services')->where('id',$service->id)],
            $request->boss => ['required',Rule::unique('services')->where('directeur_id',$service->directeur_id)]
        ]);
        $service->update([
            'lib'=>$request->lib,
            'directeur_id' =>$request->boss
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