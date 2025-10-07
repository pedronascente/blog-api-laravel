<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permite qualquer usuário acessar
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}
