<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
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
            'typeDem'=>['required'],
            'objet'=>['required','max:128','min:5'],
            'dateDeb'=>['required','date','after_or_equal:now'],
            'duree'=>['integer']
        ];
    }
}
