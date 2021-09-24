<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *a
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
            'nom' => ['required', 'string', 'max:60','min:3'],
            'prenom' => ['required', 'string', 'max:60','min:3'],
            'sexe' => ['required'],
            'natCont' => ['required'],
            'adresse' => ['required', 'string', 'max:60','min:3'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email'],
            'tel' => ['required', 'string','min:8','unique:users,tel'],            
            'password' => ['required', 'confirmed', Rules\Password::defaults(),'unique:users,password'],
            'dateEmb' => ['required', 'date','before_or_equal:now'],
            'service' => ['required'],
            'dureCont' =>['required_if:natCont,==,CDD'],
            'fonction' => ['required']
        ];
    }
}
