<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeechRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'nombreSpeech' => 'required',
            'descripcionSpeech' => 'required',
        ];
        /*
        $rules = ['dataForm.tipo' => 'required',
                  'dataForm.nombre' => 'required',
                  'dataForm.descripcion' => 'required',
                  'dataForm.nombreSpeech' => 'required',
                  'dataForm.descripcionSpeech' => 'required'];
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
}
