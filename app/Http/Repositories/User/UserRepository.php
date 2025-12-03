<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use App\Http\Contracts\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(CreateUserDTO $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);
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