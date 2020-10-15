<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearHechoVictimizante extends FormRequest
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
            'name' => 'required|unique:hecho_victimizantes',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'El Hecho Victimizante ya se encuentra registrado.',
            'name.required' => 'El nombre del Hecho Victimizante es obligatorio.',

        ];
    }
}
