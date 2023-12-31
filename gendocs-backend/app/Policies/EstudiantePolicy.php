<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstudiantePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->getAllPermissions()->contains('name', Permissions::Estudiantes['index']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Estudiante $estudiante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Estudiante $estudiante)
    {
        return $user->getAllPermissions()->contains('name', Permissions::Estudiantes['index']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->getAllPermissions()->contains('name', Permissions::Estudiantes['create']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Estudiante $estudiante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Estudiante $estudiante)
    {
        return $user->getAllPermissions()->contains('name', Permissions::Estudiantes['update']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Estudiante $estudiante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Estudiante $estudiante)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Estudiante $estudiante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Estudiante $estudiante)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Estudiante $estudiante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Estudiante $estudiante)
    {
        //
    }
}
