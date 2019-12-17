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
            'media_server' => 'required',
            'Cat_Base_Datos_id' => 'required',
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
            'media_server' => 'Media_Server',
            'Cat_Base_Datos_id' => 'Base de Datos',
            'ip_pbx' => 'Ip PBX',
        ];
    }
}
