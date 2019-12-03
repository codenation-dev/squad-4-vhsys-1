<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExclusionsRequest extends FormRequest
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
    public function rules()
    {
        return [
            'valor' => 'required',
            'id_user' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'valor.required' => 'Campo  é obrigatório!',
            'id_user.required' => 'Campo  é obrigatório!',
        ];
    }
}
