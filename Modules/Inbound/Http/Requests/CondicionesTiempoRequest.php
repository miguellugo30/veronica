<?php

namespace Modules\Inbound\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CondicionesTiempoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['dataForm.nombre' => 'required'];

        foreach ($this->request->get('dataForm') as $key => $value)
        {
            /**
             * Buscamos si el id_campo es null para permitir agregar los nuevos campos
             **/
            if ($key == strpos($key,'id_campo')) {
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
