<?php

namespace Modules\Administrador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoClienteRequest extends FormRequest
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
            'descripcion' => 'required',
            'marcar' => 'required',
            'mostrar_agente' => 'required',
            'parametrizar' => 'required',
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
            'descripcion' => 'Descripcion',
            'marcar' => 'Marcar',
            'mostrar_agente' => 'Mostrar Agente',
            'parametrizar' => 'Parametrizar',
        ];
    }
}
