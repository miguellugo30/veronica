<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilMarcacionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prefijo' => 'required',
            'perfil' => 'required',
            'canal' => 'required',
            'did' => 'required',
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
            'prefijo' => 'Prefijo',
            'perfil' => 'Perfil',
            'canal' => 'Canal',
            'did' => 'Did',
        ];
    }

    public function messages()
    {
        return [
            'did.unique' => 'Este Perfil de marcacion ya ha sido registrado, favor de seleccionar otro',
        ];
    }
}
