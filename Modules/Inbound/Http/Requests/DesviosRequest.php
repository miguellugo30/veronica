<?php

namespace Modules\Inbound\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesviosRequest extends FormRequest
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
            'Canales_id' => 'required',
            'dial' => 'required|numeric',
            'ringeo' => 'required|numeric|min:10',
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
            'Canales_id' => 'Canal',
            'dial' => 'Destino',
            'ringeo' => 'Tiempo de Ringeo',
        ];
    }
}
