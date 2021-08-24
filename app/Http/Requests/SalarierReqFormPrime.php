<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalarierReqFormPrime extends FormRequest
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
            'nom'=>['required','min:5','max:30'],
            'prenom'=>['required','min:5','max:35'],
            'adresse'=>['required','min:5','max:35'],
            'telephone'=>['required','min:8','max:12'],
            'dateEmbauche'=>['required','date','before:tomorrow'],
            'natCont'=>['required'],
            'fonction'=>['required'],
            'civilite'=>['required'],
            'service'=>['required']
        ];
    }
}
