<?php

namespace App\Policies;

use App\Http\Enums\Roles;
use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    /**
     * Determine whether the user can view any models.
     * Accountants and admins can view invoices.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [Roles::ADMIN->value, Roles::ACCOUNTANT->value]);
    }

    /**
     * Determine whether the user can view the model.
     * Accountants and admins can view invoices.
     */
    public function view(User $user, Invoice $invoice): bool
    {
        return in_array($user->role, [Roles::ADMIN->value, Roles::ACCOUNTANT->value]);
    }

    /**
     * Determine whether the user can create models.
     * Only admins can create invoices.
     */
    public function create(User $user): bool
    {
        return $user->role === Roles::ADMIN->value;
    }

    /**
     * Determine whether the user can update the model.
     * Only admins can update invoices.
     */
    public function update(User $user, Invoice $invoice): bool
    {
        return $user->role === Roles::ADMIN->value;
    }

    /**
     * Determine whether the user can delete the model.
     * Only admins can delete invoices.
     */
    public function delete(User $user, Invoice $invoice): bool
    {
        return $user->role === Roles::ADMIN->value;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Invoice $invoice): bool
    {
        return $user->role === Roles::ADMIN->value;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Invoice $invoice): bool
    {
        return $user->role === Roles::ADMIN->value;
    }
}
