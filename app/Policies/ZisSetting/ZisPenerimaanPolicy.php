<?php

namespace App\Policies\ZisSetting;

use App\Models\User;
use App\Models\Zis\ZisPenerimaan;
use Illuminate\Auth\Access\Response;

class ZisPenerimaanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ZisPenerimaan $zisPenerimaan): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ZisPenerimaan $zisPenerimaan): bool
    {
        if($user->id == $zisPenerimaan->amil || $user->can('Manage : Zis')){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ZisPenerimaan $zisPenerimaan): bool
    {
        return $user->can(['Manage : Zis']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ZisPenerimaan $zisPenerimaan): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ZisPenerimaan $zisPenerimaan): bool
    {
        return $user->hasRole(['Admin']);
    }
}
