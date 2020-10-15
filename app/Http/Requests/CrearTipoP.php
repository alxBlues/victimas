<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearTipoP extends FormRequest
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
          'name' => 'unique:tipo_poblacions|required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'El Tipo de población ya se encuentra registrado.',
            'name.required' => 'El nombre del tipo de población es obligatorio.',

        ];
    }
}
