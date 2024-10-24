<?php

namespace App\Policies;

use App\Models\Research;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ResearchPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Allow all users to view the list of researches
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Research $research): bool
    {
        return $user->id === $research->user_id ||
               $user->role === 'admin' ||
               ($user->role === 'committee_member' && $user->department_id === $research->user->department_id);
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
    public function update(User $user, Research $research): bool
    {
        return $user->id === $research->user_id ||
               $user->role === 'admin' ||
               ($user->role === 'committee_member' && $user->department_id === $research->user->department_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Research $research): bool
    {
        return $user->id === $research->user_id ||
               $user->role === 'admin' ||
               ($user->role === 'committee_member' && $user->department_id === $research->user->department_id);
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function approve(User $user, Research $research): bool
    {
        return $user->id === $research->user_id ||
               $user->role === 'admin' ||
               ($user->role === 'committee_member' && $user->department_id === $research->user->department_id);
    }

    public function revoke(User $user, Research $research): bool
    {
        return $user->role === 'admin';
    }
}
