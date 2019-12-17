<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalificacionesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
            'nombre_calificacion' => 'required',
            'formulario_calificacion' => 'required',
        ];
        */

        $rules = ['dataForm.nombre' => 'required',
                  'dataForm.descripcion' => 'required',
                  'dataForm.nombre_calificacion' => 'required',
                  'dataForm.formulario_calificacion' => 'required'];
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
