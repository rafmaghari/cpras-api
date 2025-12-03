<?php

namespace App\Http\Contracts\User;

use App\Http\DTO\User\CreateUserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function create(CreateUserDTO $dto): User;

    public function findByEmail(string $email): User;
    
    public function findById(int $id): User;
}