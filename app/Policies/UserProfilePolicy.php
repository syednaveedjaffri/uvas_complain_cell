<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Userprofile;
use App\Models\User;

class UserProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasRole(['super-admin','admin','user']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Userprofile  $userprofile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Userprofile  $userprofile)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole(['super-admin','admin','user']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Userprofile  $userprofile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Userprofile  $userprofile)
    {
        return $user->hasRole(['super-admin','admin','user']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Userprofile  $userprofile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Userprofile  $userprofile)
    {
        return $user->hasRole(['super-admin','admin','user']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Userprofile  $userprofile)
    {
        return $user->hasRole(['super-admin','admin','user']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Userprofile  $userprofile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Userprofile  $userprofile)
    {
        return $user->hasRole(['super-admin','admin','user']);
    }
}
