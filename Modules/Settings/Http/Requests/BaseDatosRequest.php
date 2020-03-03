<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class baseDatosRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'plantilla' => 'required',
            //'archivo_datos' => 'required|mimes:csv,xlsx,xls',
            //'archivo_datos' => 'required',
        ];
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

    public function attributes()
    {
        return[
            'nombre' => 'Nombre',
            'plantilla' => 'Plantilla',
            //'archivo_datos' => 'Archivo',
        ];
    }
}
