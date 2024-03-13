<?php
namespace App\Policies;

use App\Models\SalesDetail;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesDetailPolicy
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
        return $user->hasPermissionTo('sales-details.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  SalesDetail  $salesDetail
     * @return mixed
     */
    public function view(User $user, SalesDetail $salesDetail)
    {
        return $user->hasPermissionTo('sales-details.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('sales-details.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  SalesDetail  $salesDetail
     * @return mixed
     */
    public function update(User $user, SalesDetail $salesDetail)
    {
        return $user->hasPermissionTo('sales-details.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  SalesDetail  $salesDetail
     * @return mixed
     */
    public function delete(User $user, SalesDetail $salesDetail)
    {
        return $user->hasPermissionTo('sales-details.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  SalesDetail  $salesDetail
     * @return mixed
     */
    public function restore(User $user, SalesDetail $salesDetail)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  SalesDetail  $salesDetail
     * @return mixed
     */
    public function forceDelete(User $user, SalesDetail $salesDetail)
    {
        return $user->hasPermissionTo('sales-details.delete');
    }
}
