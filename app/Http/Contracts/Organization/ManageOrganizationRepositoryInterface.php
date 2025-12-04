<?php

namespace App\Http\Contracts\Organization;

use App\Models\Organization;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ManageOrganizationRepositoryInterface
{
    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator;

    public function addOwnerToOrganization(int $organizationId, int $userId, string $role): Organization;

    public function removeUserFromOrganization(int $organizationId, int $userId): Organization;
}
