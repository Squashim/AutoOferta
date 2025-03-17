<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','max:64', 'alpha'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Nazwa użytkownika jest wymagana.',
        'name.string' => 'Nazwa użytkownika musi być tekstem.',
        'name.max' => 'Nazwa użytkownika może zawierać maksymalnie 64 znaków.',
        'name.alpha' => 'Nazwa użytkownika może zawierać tylko znaki.',

        'email.required' => 'Adres e-mail jest wymagany.',
        'email.string' => 'Adres e-mail musi być tekstem.',
        'email.lowercase' => 'Adres e-mail musi być zapisany małymi literami.',
        'email.email' => 'Podaj prawidłowy adres e-mail.',
        'email.max' => 'Adres e-mail może zawierać maksymalnie 255 znaków.',
        'email.unique' => 'Ten adres e-mail jest już zajęty.',
    ];
}
}
