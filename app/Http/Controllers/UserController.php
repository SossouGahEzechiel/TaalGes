<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchReq;
use App\Http\Requests\UserReq;
use App\Models\Demande;
use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MercurySeries\Flashy\Flashy;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::simplePaginate(7);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $user = new User;
        return view('admin.user.create',compact('services','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserReq $request)
    {
        $user = User::create([
            'nom'           =>      $request->nom,
            'prenom'        =>      $request->prenom,
            'adresse'       =>      $request->adresse,
            'tel'           =>      $request->tel,
            'email'         =>      $request->email,
            'password'      =>      Hash::make($request->password),
            'sexe'          =>      $request->sexe,
            'dateEmb'       =>      $request->dateEmb,
            'natCont'       =>      $request->natCont,
            'fonction'      =>      $request->fonction,
            'service_id'    =>      $request->service,
        ]);
        
        event(new Registered($user));
        $admin = Auth::user();
        Auth::login($user);
        Auth::logout($user);
        Auth::login($admin);
        function message($user)
        {
            if ($user->sexe == "M") {
                return "ajouté";
            } else {
                return "ajoutée";
            }
        }
        Flashy::success(sprintf("Salarié %s %s avec succès",$user->nom,message($user)));
        return redirect(route('user.show',$user));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        if (Auth::user()->fonction == "user") {
            return view('user.self.show',compact('user'));
        }
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $services = Service::all();
        return view('admin.user.edit',compact('services','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserReq $request, User $user)
    {
        $user->update([
            'nom'           =>      $request->nom,
            'prenom'        =>      $request->prenom,
            'adresse'       =>      $request->adresse,
            'tel'           =>      $request->tel,
            'email'         =>      $request->email,
            'password'      =>      $request->password,
            'sexe'          =>      $request->sexe,
            'dateEmb'       =>      $request->dateEmb,
            'natCont'       =>      $request->natCont,
            'fonction'      =>      $request->fonction,
            'service_id'    =>      $request->service,
        ]);
        
        Flashy::success(sprintf("Données du salarié %s ont été mises à jour avec succès",$user->nom));
        return redirect(route('user.show',$user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Flashy::error(sprintf("Salarié %s retiré avec succès",$user->nom));
        return redirect(route('admin.index'));
    }

    public function search(SearchReq $request)
    {
        $users = User::where('nom','like',"%$request->search%")
            ->orWhere('prenom','like',"%$request->search%")->get();
        return view('admin.user.search',compact('users','request'));
    }
    public function profil()
    {
        $demandes = Demande::where('user_id',Auth::user()->id);
        return view('user.demande.index',compact('demandes'));
    }
}
