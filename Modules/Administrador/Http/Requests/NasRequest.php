<?php

namespace Modules\Administrador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NasRequest extends FormRequest
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
            'ip_nas' => 'required|ip',
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
            'ip_nas' => 'IP NAS',
        ];
    }
}
