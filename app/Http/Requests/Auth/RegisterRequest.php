<?php

namespace App\Http\Requests\Auth;

use App\Enums\Gender;
use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:' . config('validate.max_length.name')],
            'last_name' => ['required', 'string', 'max:' . config('validate.max_length.name')],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'gender' => ['required', Rule::in(array_column(Gender::cases(), 'value'))],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png', 'mimetypes:image/jpeg,image/png', 'max:' . config('upload.size_max')],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'email' => ['required', 'email', 'max:' . config('validate.max_length.email'), Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'max:' . config('validate.max_length.password'), new Password(), 'confirmed'],
            'g-recaptcha-response' => [config('services.recaptcha.enabled') ? 'required' : 'nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => trim((string) $this->input('first_name')),
            'last_name' => trim((string) $this->input('last_name')),
            'email' => Str::lower(trim((string) $this->input('email'))),
        ]);
    }
}
