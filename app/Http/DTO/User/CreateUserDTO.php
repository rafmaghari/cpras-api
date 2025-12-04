<?php

namespace App\Http\DTO\User;

use App\Http\Enums\Roles;

class CreateUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $role = null
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role ?? Roles::ADMIN->value,
        ];
    }
}
