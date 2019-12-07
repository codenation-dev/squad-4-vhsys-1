<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;


class UsersRequest extends FormRequest
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
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'email' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo Nome é obrigatório!',
            'password.required' => 'Campo Pasword é obrigatório!',
            'email.required' => 'Campo E-Mail é obrigatório!',

        ];
    }
}
