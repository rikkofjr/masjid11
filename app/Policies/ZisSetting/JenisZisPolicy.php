<?php

namespace App\Policies\ZisSetting;

use App\Models\User;
use App\Models\Zis\JenisZis;
use Illuminate\Auth\Access\Response;

class JenisZisPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(['Manage : Zis']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JenisZis $jenisZis): bool
    {
        return $user->can(['Manage : Zis']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(['Manage : Zis']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JenisZis $jenisZis): bool
    {
        return $user->can(['Manage : Zis']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JenisZis $jenisZis): bool
    {
        return $user->can(['Manage : Zis']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JenisZis $jenisZis): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JenisZis $jenisZis): bool
    {
        return $user->hasRole(['Admin']);
    }
}
