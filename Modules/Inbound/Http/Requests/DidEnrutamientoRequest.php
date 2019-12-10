<?php

namespace Modules\Inbound\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DidEnrutamientoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*
        return [
            'dataForm.descripcion' => 'required',
        ];
        */
        $rules = ['dataForm.descripcion' => 'required'];

        foreach ($this->request->get('dataForm') as $key => $value)
        {
            $rules[ 'dataForm.'.$key] = 'required';
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
