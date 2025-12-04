<?php

namespace App\Policies;

use App\Http\Enums\Roles;
use App\Models\User;

class ManageOrganizationPolicy
{
    /**
     * Determine whether the user can view the organization users list.
     * Only admins can view organization users.
     */
    public function viewUsers(User $user): bool
    {
        return $user->role === Roles::ADMIN->value;
    }

    /**
     * Determine whether the user can add users to organization.
     * Only admins can add users.
     */
    public function addUser(User $user): bool
    {
        return $user->role === Roles::ADMIN->value;
    }

    /**
     * Determine whether the user can remove users from organization.
     * Only admins can remove users.
     */
    public function removeUser(User $user): bool
    {
        return $user->role === Roles::ADMIN->value;
    }
}
