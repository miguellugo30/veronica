<?php

namespace Modules\Administrador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistribuidoresRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'servicio' => 'required',
            'distribuidor' => 'required',
            'numero_soporte' => 'required|numeric',
            'prefijo' => 'required|numeric',
            //'img_header' => 'required|image',
            //'img_pie' => 'required|image',
        ];
        /*
        $rules = ['data.servicio' => 'required'];

        foreach ($this->request->get('data') as $key => $value)
        {
            $rules[ 'data.'.$key] = 'required';
        }

        return $rules;
        */
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
            'servicio' => 'Servicio',
            'distribuidor' => 'Distribuidor',
            'numero_soporte' => 'Numero de Soporte',
            'prefijo' => 'Prefijo',
        ];
    }
}
