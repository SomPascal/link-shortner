<?php

namespace App\Http\Requests\web\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return ! Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:24'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],

            'password' => [
                'required', 
                'string', 

                Password::min(6)
                ->max(255)
                ->letters()
                ->numbers()
                ->uncompromised(),

                'confirmed:password_again'
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email is already taken.'
        ];
    }
}
