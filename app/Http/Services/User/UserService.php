<?php

namespace App\Http\Services\User;

use App\Http\DTO\User\CreateUserDTO;
use App\Http\Repositories\User\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository) {}

    public function create(CreateUserDTO $dto): User
    {
        return $this->userRepository->create($dto);
    }

    public function findByEmail(string $email): User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function findById(int $id): User
    {
        return $this->userRepository->findById($id);
    }
}
