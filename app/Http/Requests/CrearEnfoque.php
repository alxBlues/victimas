<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearEnfoque extends FormRequest
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
           'name' => 'unique:enfoque_poblacionals|required',
         ];
     }

     public function messages()
     {
         return [
             'name.unique' => 'El Enfoque Poblacional ya se encuentra registrado.',
             'name.required' => 'El nombre del Enfoque Poblacional es obligatorio.',

         ];
     }
}
