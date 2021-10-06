<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterReq;
use App\Mail\UserRegisterMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

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
    public function store(HttpFoundationRequest $request)
    {
        $user = User::create([
            'nom'           =>      'SOSSOU-GAH',
            'prenom'        =>      'Ezéchiel Godwill',
            'adresse'       =>      'Baguida',
            'tel'           =>      '99245957',
            'email'         =>      'ezecsossougah@gmail.com',
            'password'      =>      Hash::make('admin'),
            'sexe'          =>      'M',
            'dateEmb'       =>      now(),
            'natCont'       =>      'CDI',
            'fonction'      =>      'admin',
            'service_id'    =>      1,
        ]);

        event(new Registered($user));

        Auth::login($user);
        Mail::to($user->email)->send(new UserRegisterMail($user,'admin'));

        return redirect(RouteServiceProvider::HOME);
    }
}
