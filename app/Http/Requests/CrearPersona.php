<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearPersona extends FormRequest
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

             'identificacion' => 'required|unique:personas|min:0',

             'primerNombre' => 'required',
             'primerApellido' => 'required',

             'tipoDoc' => 'required',
             'fechaNacimiento' => 'required',
             'telefono' => 'required|integer|min:0',
             'grado' => 'required',

             'area' => 'required',
             'estrato' => 'required',
             'salud' => 'required',
             'genero_id' => 'required',
             'tipoP_id' => 'required',
             'enfoqueP_id' => 'required',
             'hechosV' => 'required',

         ];
     }

     public function messages()
     {
         return [
             'identificacion.unique' => 'El número de Identificación ya se encuentra registrado',


         ];
     }
}
