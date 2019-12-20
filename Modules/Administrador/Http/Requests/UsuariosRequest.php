<?php

namespace Modules\Administrador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'id_cliente' => 'required',
            'rol' => 'required',
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
            'name' => 'Nombre',
            'email' => 'Correo Electronico',
            'password' => 'Contraseña',
            'id_cliente' => 'Cliente',
            'rol' => 'Rol',
        ];
    }
}