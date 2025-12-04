<?php

namespace App\Http\Repositories\Organization;

use App\Http\Contracts\Organization\ManageOrganizationRepositoryInterface;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ManageOrganizationRepository implements ManageOrganizationRepositoryInterface
{
    /** list of users under my organization */
    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator
    {
        $organizationUsers = User::with('organization');

        if (isset($filter['name'])) {
            $organizationUsers->where('organization.name', 'like', '%'.$filter['name'].'%');
        }

        if (isset($filter['is_active'])) {
            $organizationUsers->where('organization.is_active', $filter['is_active']);
        }

        return $organizationUsers->paginate($perPage);
    }

    public function addOwnerToOrganization(int $organizationId, int $userId, string $role): Organization
    {
        $organization = Organization::find($organizationId);

        $user = User::find($userId);
        $user->update([
            'organization_id' => $organizationId,
            'role' => $role,
        ]);

        return $organization;
    }

    public function removeUserFromOrganization(int $organizationId, int $userId): Organization
    {
        $organization = Organization::find($organizationId);
        $organization->users()->detach($userId);

        return $organization;
    }
}
