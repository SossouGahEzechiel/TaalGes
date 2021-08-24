<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FonctionReqFormPrime extends FormRequest
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
            'LibelleDeLaFonction'=>['required','alpha','min:5','max:25']
        ];
    }
}
