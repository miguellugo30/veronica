<?php

namespace Modules\Administrador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PbxRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'basedatos' => 'required',
            'media_server' => 'required',
            'ip_pbx' => 'required|ip',
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

            'basedatos' => 'Base de Datos',
            'media_server' => 'Media Server',
            'ip_pbx' => 'IP PBX',
        ];
    }
}
