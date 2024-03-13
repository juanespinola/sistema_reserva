<?php
namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
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
        return $user->hasPermissionTo('suppliers.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Supplier  $supplier
     * @return mixed
     */
    public function view(User $user, Supplier $supplier)
    {
        return $user->hasPermissionTo('suppliers.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('suppliers.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Supplier  $supplier
     * @return mixed
     */
    public function update(User $user, Supplier $supplier)
    {
        return $user->hasPermissionTo('suppliers.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Supplier  $supplier
     * @return mixed
     */
    public function delete(User $user, Supplier $supplier)
    {
        return $user->hasPermissionTo('suppliers.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  Supplier  $supplier
     * @return mixed
     */
    public function restore(User $user, Supplier $supplier)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Supplier  $supplier
     * @return mixed
     */
    public function forceDelete(User $user, Supplier $supplier)
    {
        return $user->hasPermissionTo('suppliers.delete');
    }
}
