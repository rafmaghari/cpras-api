<?php

namespace App\Http\Repositories\User;

use App\Http\Contracts\User\UserRepositoryInterface;
use App\Http\DTO\User\CreateUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(CreateUserDTO $dto, array $additionalAttributes = []): User
    {
        return User::create(array_merge([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'role' => $dto->role,
        ], $additionalAttributes ?? []));
    }

    public function findByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public function findById(int $id): User
    {
        return User::find($id);
    }
}
