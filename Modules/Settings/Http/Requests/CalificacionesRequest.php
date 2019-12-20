<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalificacionesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        foreach ($this->request->get('dataForm') as $key => $value)
        {
            /**
             * Buscamos si el id_calificacion es null para permitir agregar las nuevas calificaciones
             **/
            if ($key == strpos($key,'id_calificacion')) {
                $rules[ 'dataForm.'.$key] = 'nullable';
            } else {
                $rules[ 'dataForm.'.$key] = 'required';
            }
        }

        return $rules;
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
