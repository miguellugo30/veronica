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
        $rules = ['dataForm.descripcion' => 'required'];

        foreach ($this->request->get('dataForm') as $key => $value)
        {
            if ( !preg_match('*\bid\b*i', str_replace('_', ' ', $key)) )
            {
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
