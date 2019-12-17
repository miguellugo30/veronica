<?php

namespace Modules\Inbound\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuzonVozRequest extends FormRequest
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
            'tiempo_maximo' => 'required|numeric',
            'terminacion' => 'required',
            'Audios_Empresa_id' => 'required',
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
            'tiempo_maximo' => 'Tiempo Máximo de Grabación',
            'dial' => 'Terminar Grabación',
            'ringeo' => 'Anuncio del Buzón',
        ];
    }
}
