<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterReq extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email'],
            'tel' => ['required', 'string', 'max:15','min:8','unique:users,tel'],    
            'password' => ['required', 'confirmed', Rules\Password::defaults(),'unique:users,password'],
            'dateEmbauche' => ['required', 'date','before_or_equal:now'],
            'service' => ['required'],
            'fonction' => ['required'],
        ];
    }
}
