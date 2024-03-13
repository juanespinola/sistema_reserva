<?php
namespace App\Policies;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingPolicy
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
        return $user->hasPermissionTo('ratings.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Rating  $rating
     * @return mixed
     */
    public function view(User $user, Rating $rating)
    {
        return $user->hasPermissionTo('ratings.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('ratings.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Rating  $rating
     * @return mixed
     */
    public function update(User $user, Rating $rating)
    {
        return $user->hasPermissionTo('ratings.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Rating  $rating
     * @return mixed
     */
    public function delete(User $user, Rating $rating)
    {
        return $user->hasPermissionTo('ratings.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  Rating  $rating
     * @return mixed
     */
    public function restore(User $user, Rating $rating)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Rating  $rating
     * @return mixed
     */
    public function forceDelete(User $user, Rating $rating)
    {
        return $user->hasPermissionTo('ratings.delete');
    }
}
