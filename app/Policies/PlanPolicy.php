<?php
namespace App\Policies;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('plans.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Plan  $plan
     * @return mixed
     */
    public function view(User $user, Plan $plan)
    {
        return $user->hasPermissionTo('plans.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('plans.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Plan  $plan
     * @return mixed
     */
    public function update(User $user, Plan $plan)
    {
        return $user->hasPermissionTo('plans.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Plan  $plan
     * @return mixed
     */
    public function delete(User $user, Plan $plan)
    {
        return $user->hasPermissionTo('plans.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  Plan  $plan
     * @return mixed
     */
    public function restore(User $user, Plan $plan)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Plan  $plan
     * @return mixed
     */
    public function forceDelete(User $user, Plan $plan)
    {
        return $user->hasPermissionTo('plans.delete');
    }
}
