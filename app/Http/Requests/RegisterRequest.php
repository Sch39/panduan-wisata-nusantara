<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:4'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::default(), 'confirmed'],
            'password_confirmation' => ['required'],
            'terms_of_service_and_privacy_policy' => ['accepted'],
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ];
    }
}
