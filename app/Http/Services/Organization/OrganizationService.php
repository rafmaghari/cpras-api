<?php

namespace App\Http\Services\Organization;

use App\Http\DTO\Organization\OrganizationDTO;
use App\Http\Enums\Roles;
use App\Http\Repositories\Organization\ManageOrganizationRepository;
use App\Http\Repositories\Organization\OrganizationRepository;
use App\Models\Organization;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrganizationService
{
    public function __construct(
        private OrganizationRepository $organizationRepository,
        private ManageOrganizationRepository $manageOrganizationRepository
    ) {}

    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator
    {
        return $this->organizationRepository->paginate($perPage, $filter);
    }

    public function findById(int $id): Organization
    {
        return $this->organizationRepository->findById($id);
    }

    public function create(OrganizationDTO $dto): Organization
    {
        $organization = $this->organizationRepository->create($dto);

        $this->manageOrganizationRepository->addOwnerToOrganization(
            $organization->id,
            auth()->user()->id,
            Roles::ADMIN->value
        );

        return $organization;
    }

    public function update(OrganizationDTO $dto, Organization $organization): Organization
    {
        return $this->organizationRepository->update($dto, $organization);
    }

    public function delete(Organization $organization): void
    {
        $this->organizationRepository->delete($organization);
    }
}
