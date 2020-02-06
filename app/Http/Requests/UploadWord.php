<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadWord extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'fileAnswer'=>'mimes:doc,docx,dot |required',
        ];
    }
    public function messages(){
        return [
            'fileAnswer.mimes' => 'Debe ser un archivo Word',
            'fileAnswer.required' => 'El campo se encuentra vacio',
        ];
    }
}
