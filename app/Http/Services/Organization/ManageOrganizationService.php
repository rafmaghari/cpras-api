<?php

namespace App\Http\Services\Organization;

use App\Http\DTO\User\CreateUserDTO;
use App\Http\Repositories\Organization\ManageOrganizationRepository;
use App\Http\Repositories\User\UserRepository;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ManageOrganizationService
{
    public function __construct(
        private ManageOrganizationRepository $manageOrganizationRepository,
        private UserRepository $userRepository
    ) {}

    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator
    {
        return $this->manageOrganizationRepository->paginate($perPage, $filter);
    }

    public function addOwnerToOrganization(int $organizationId, int $userId, string $role): Organization
    {
        return $this->manageOrganizationRepository->addOwnerToOrganization($organizationId, $userId, $role);
    }

    public function addUserToOrganization(CreateUserDTO $dto): User
    {
        $user = $this->userRepository->create($dto);
        
        return $user;
    }

    public function removeUserFromOrganization(int $organizationId, int $userId): Organization
    {
        return $this->manageOrganizationRepository->removeUserFromOrganization($organizationId, $userId);
    }
}
