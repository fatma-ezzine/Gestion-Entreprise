<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class SalarieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|max:255',
            'cin'=>'required|min:8|max:8',
            'gouvernorat' => 'required|max:255',
            'ville' => 'required|max:255'
         ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nom.required'=>'Nom Obligatoire',
            'cin.required'=>'CIN Obligatoire',
            'gouvernorat.required'=> 'Gouvernorat Obligatoire',
            'ville.required'=> 'Ville Obligatoire'
        ];
    }
}
