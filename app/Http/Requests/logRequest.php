<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class logRequest extends FormRequest
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
            'level' => 'required|max:64',
            'log' => 'required|max:255',
            'events' => 'required|max:255',
            'ambience' => 'required|max:255',
            'title' => 'required|max:255',

        ];
    }
    public function messages()
    {
        return [
            'level.required' => 'Campo Level é obrigatório!',
            'log.required' => 'Campo Log é obrigatório!',
            'events.required' => 'Campo Evento é obrigatório!',
            'ambience.required' => 'Campo Ambiente é obrigatório!',
            'title.required' => 'Campo Titulo é obrigatório!',
        ];
    }
}
