<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule as ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => ['required', 'string', 'max:255','min:3'],
            'prenom' => ['required', 'string', 'max:255','min:3'],
            'sexe' => ['required'],
            'natCont' => ['required'],
            'adresse' => ['required', 'string', 'max:255','min:3'],
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('users','email')
                ->where(function($query){
                    return ($query->where('email',Auth::user()->email));
                })             
            ],
            'tel' => ['required', 'string', 'max:15','min:8',
                Rule::unique('users','tel')
                ->where(function($query){
                    return $query->whereTel(Auth::user()->tel);
                })    
            ],            
            'password' => ['required', 'confirmed', Rules\Password::defaults(),
                Rule::unique('users','password')
                ->where(function($query){
                    return $query->wherePassword(Auth::user()->password);
                }) 
            ],
            'dateEmb' => ['required', 'date','before_or_equal:now'],
            'service' => ['required'],
            'fonction' => ['required'],
        ];
    }
}
