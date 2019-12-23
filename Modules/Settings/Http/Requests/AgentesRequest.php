<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'grupo' => 'required',
            'tipo_licencia' => 'required',
            'nivel' => 'required',
            'nombre' => 'required',
            'usuario' => 'required',
            'contrasena' => 'required',
            'extension' => 'required|numeric',
            'canal' => 'required',
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
            'grupo' => 'Grupo',
            'tipo_licencia' => 'Tipo Licencia',
            'nivel' => 'Nivel',
            'nombre' => 'Nombre',
            'usuario' => 'Usuario',
            'contrasena' => 'Contraseña',
            'Canales_id' => 'Canal',
            'extension' => 'Extension',
        ];
    }
}
