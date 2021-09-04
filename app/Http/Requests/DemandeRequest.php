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
            'objet'=>['required','max:100','min:5'],
            'dateDeb'=>['required','date',"after:tomorrow"],
            'dure'=>['numeric:1,30']
        ];
    }
}
