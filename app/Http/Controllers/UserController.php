<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TestMail;
use App\Models\Demand;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\UserReq;
use App\Mail\UserRegisterMail;
use Illuminate\Validation\Rule;
use App\Http\Requests\SearchReq;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public $old;
    public function __construct() {
        $this->middleware(['auth']);
        $this->middleware(['auth','admin'])->only(['index','create','delete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = User::all()->count();
        $users = User::simplePaginate(20);
        return view('admin.user.index',compact('users','total'));
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
            'dureCont'       =>      $request->dureCont,
            'fonction'      =>      $request->fonction,
            'service_id'    =>      $request->service,
        ]);
        
        event(new Registered($user));
        
        $admin = Auth::user();
        Auth::login($user);
        Auth::logout($user);
        Auth::login($admin);

        Mail::to($user->email)->send(new UserRegisterMail($user,$request->password));
        function message($user)
        {
            if ($user->sexe == "M") {
                return "ajouté";
            } else {
                return "ajoutée";
            }
        }
    
        Flashy::success(sprintf("Salarié %s %s avec succès",$user->nom,message($user)));
        Flashy::success(sprintf("Mail envoyé avec succès à %s",$user->nom));
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
        $departement = Service::whereDirecteur_id($user->id)->first();
        $last = Demand::whereUser_id($user->id)->get()->max('dateDeb');
        if (Auth::user()->fonction == "user") {
            return view('user.self.show',compact('user','last','departement'));
        }
        return view('admin.user.show',compact('user','last','departement'));
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
    public function update(Request $request, User $user)
    {
        $this->old = $user->id;

        if (Auth::user()->fonction === "user") {
            $request->validate([
                'nom' => ['required', 'string', 'max:255','min:3'],
                'prenom' => ['required', 'string', 'max:255','min:3'],
                'sexe' => ['required'],
                'adresse' => ['required', 'string', 'max:255','min:3'],
                'email' => ['required', 'string', 'email', 'max:255',
                    Rule::unique('users','email')
                    ->where(function($query){
                        return ($query->where('email',Auth::user()->id));
                    })             
                ],
                'tel' => ['required', 'string','min:8',
                    Rule::unique('users','tel')
                    ->where(function($query){
                        return $query->whereTel(Auth::user()->id);
                    })    
                ],       
            ]);

            $user->update([
                'nom'           =>      $request->nom,
                'prenom'        =>      $request->prenom,
                'adresse'       =>      $request->adresse,
                'tel'           =>      $request->tel,
                'email'         =>      $request->email,
                'sexe'          =>      $request->sexe,
            ]);
            Flashy::success(sprintf("Vos données ont été mises à jour avec succès",$user->nom));
        } else {
            $request->validate([
                'nom' => ['required', 'string', 'max:255','min:3'],
                'prenom' => ['required', 'string', 'max:255','min:3'],
                'sexe' => ['required'],
                'natCont' => ['required'],
                'adresse' => ['required', 'string', 'max:255','min:3'],
                'email' => ['required', 'string', 'email', 'max:255',
                    Rule::unique('users','email')
                    ->where(function($query){
                        return ($query->where('email',$this->old));
                    })             
                ],
                'tel' => ['required', 'string','min:8',
                    Rule::unique('users','tel')
                    ->where(function($query){
                        return $query->whereTel($this->old);
                    })    
                ],
                'dateEmb' => ['required', 'date','before_or_equal:now'],
                'service' => ['required'],
                'fonction' => ['required'],
                'dureCont' =>['required_if:natCont,CDD']
            ]);

            $user->update([
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
            Flashy::success(sprintf("Les modifications des données du salarié %s ont été mises à jour avec succès",$user->nom));
        }
        
        return redirect(route('user.show',$user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->isBoss()) {
            return back()->with('status','Cet salarié ne peut être supprimé en étant toujours chef d\'un service');
        }
        $user->delete();
        Flashy::success(sprintf("Salarié %s retiré avec succès",$user->nom));
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
        $demandes = Demand::where('user_id',Auth::user()->id)->simplePaginate(15);
        return view('user.demande.index',compact('demandes'));
    }

    public function mail()
    {
        // Flashy::success("Mail envoyé avec succés");
        return Mail::to('ezecsossougah@gmail.com')->send(new TestMail(Auth::user(),'Ma première demande'));
    }
}
