<?php

namespace App\Http\Requests\web\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'string', 'max:255'],
            'remember_me' => ['required', 'boolean']
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'remember_me' => $this->input('remember_me', 'off') === 'on' 
        ]);
    }
}
