<?php

namespace Modules\Administrador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresasRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'dataForm.distribuidores_empresa' => 'required',
            'dataForm.nombre' => 'required',
            'dataForm.contacto_cliente' => 'required',
            'dataForm.direccion' => 'required',
            'dataForm.ciudad' => 'required',
            'dataForm.estado' => 'required',
            'dataForm.pais' => 'required',
            'dataForm.telefono' => 'required|numeric',
            'dataForm.movil' => 'required|numeric',
            'dataForm.correo' => 'required|email',
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
            'distribuidores_empresa' => 'Distribuidor Empresa',
            'nombre' => 'Nombre',
            'contacto_cliente' => 'Contacto Cliente',
            'direccion' => 'Direccion',
            'ciudad' => 'Ciudad',
            'estado' => 'Estado',
            'pais' => 'Pais',
            'telefono' => 'Telefono',
            'movil' => 'Movil',
            'correo' => 'Correo Electronico',
        ];
    }
}
