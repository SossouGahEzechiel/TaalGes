<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterReq;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterReq $request)
    {
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sexe' => $request->sexe,
            'dateEmb' => $request->dateEmbauche,
            'natCont' => $request->natCont,
            'fonction' => $request->fonction,
            'service_id' => $request->service,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
