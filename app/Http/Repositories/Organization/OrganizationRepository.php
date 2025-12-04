<?php

namespace App\Http\Repositories\Organization;

use App\Http\Contracts\Organization\OrganizationRepositoryInterface;
use App\Http\DTO\Organization\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator
    {
        $organization = Organization::query();

        if (isset($filter['name'])) {
            $organization->where('name', 'like', '%'.$filter['name'].'%');
        }

        if (isset($filter['is_active'])) {
            $organization->where('is_active', $filter['is_active']);
        }

        return $organization->paginate($perPage);
    }

    public function create(OrganizationDTO $dto): Organization
    {
        return Organization::create($dto->toArray());
    }

    public function update(OrganizationDTO $dto, Organization $organization): Organization
    {
        return $organization->update($dto->toArray());
    }

    public function findById(int $id): Organization
    {
        return Organization::find($id);
    }

    public function delete(Organization $organization): void
    {
        $organization->delete();
    }
}
