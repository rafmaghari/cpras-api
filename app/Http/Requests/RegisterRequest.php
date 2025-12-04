<?php

namespace App\Http\Requests;

use App\Http\DTO\User\CreateUserDTO;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Enums\Roles;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['nullable', 'string', Rule::enum(Roles::class)],
        ];
    }

    public function toDTO(): CreateUserDTO
    {
        return new CreateUserDTO(
            name: $this->name,
            email: $this->email,
            password: $this->password,
            role: $this->role,
        );
    }
}
