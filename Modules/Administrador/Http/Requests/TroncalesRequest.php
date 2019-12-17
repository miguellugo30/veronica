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
            'nombre' => 'required',
            'descripcion' => 'required',
            //'Cat_IP_PBX_id' => 'required',
            'ip_host' => 'required|ip',
            'Cat_Distribuidor_id' => 'required',
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
            'ip_host' => 'Ip Host',
            'Cat_Distribuidor_id' => 'Distribuidor',
        ];
    }
}
