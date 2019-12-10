<?php

namespace Modules\Inbound\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampanasRequest extends FormRequest
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
            'mlogeo' => 'required',
            'strategy' => 'required',
            'wrapuptime' => 'required|numeric|min:15|max:100',
            'periodic_announce' => 'required',
            'periodic_announce_frequency' => 'required|numeric',
            'script' => 'required',
            'alertstll' => 'required|numeric',
            'alertstdll' => 'required|numeric',
            'libta' => 'required|numeric',
            'cal_lib' => 'required',
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
            'mlogeo' => 'Modalidad de logueo',
            'strategy' => 'Estrategia de marcado',
            'wrapuptime' => 'Tiempo de Ringeo Ext. Agente',
            'periodic_announce' => 'Mensaje Agentes no disponibles',
            'periodic_announce_frequency' => 'Repetir mensaje "Agentes no disponibles"',
            'script' => 'Tipo de Script',
            'alertstll' => 'Alerta sonora tiempo en Llamada',
            'alertstdll' => 'Alerta Sonora tiempo definiendo llamada',
            'libta' => 'Liberacion de Terminal',
            'cal_lib' => 'Calificacion de Liberacion',
        ];
    }
}
