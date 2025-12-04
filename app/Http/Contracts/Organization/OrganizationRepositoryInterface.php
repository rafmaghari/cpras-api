<?php

namespace App\Http\Contracts\Organization;

use App\Http\DTO\Organization\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrganizationRepositoryInterface
{
    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator;

    public function findById(int $id): Organization;

    public function create(OrganizationDTO $dto): Organization;

    public function update(OrganizationDTO $dto, Organization $organization): Organization;

    public function delete(Organization $organization): void;
}
