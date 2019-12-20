<?php

namespace Modules\Administrador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TroncalesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'distribuidores' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'ip_host' => 'required|ip',
            'mediaserver' => 'required',
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
            'distribuidores' => 'Distribuidor',
            'nombre' => 'Troncal',
            'descripcion' => 'Descripcion',
            'ip_host' => 'Ip Host',
            'mediaserver' => 'Media Server',
        ];
    }
}
