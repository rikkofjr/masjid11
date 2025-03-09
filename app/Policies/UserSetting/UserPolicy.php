<?php

namespace App\Policies\UserSetting;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->can(['Manage : User']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model)
    {
        return $user->can(['Manage : User']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->can(['Manage : User']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model)
    {
        if ($model->username === 'admin' && !$user->hasRole('Admin')) {
            return false; // Menolak akses jika yang login bukan Admin dan mencoba mengedit admin
        }
    
        // Jika yang login adalah Admin, mereka dapat mengedit siapa saja
        if ($user->hasRole('Admin')) {
            return true;
        }
    
        // Jika yang login adalah Support Admin, mereka bisa mengedit user lain kecuali admin
        if ($user->hasRole('Support Admin')) {
            return $model->username !== 'admin'; // Tidak bisa mengedit user dengan username 'admin'
        }
    
        // Jika tidak ada peran yang memenuhi, akses ditolak
        return false;
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model)
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        return $user->hasRole(['Admin']);
    }
}
