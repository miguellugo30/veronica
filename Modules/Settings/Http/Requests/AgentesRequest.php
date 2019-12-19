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
            'grupo' => "required",
            'tipo_licencia' => "required|numeric",
            'nivel' => "required",
            'nombre' => "required",
            'usuario' => "required",
            'contrasena' => "required",
            'extension' => "required",
            'canal' => "required",
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
}
