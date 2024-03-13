<?php
namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryPolicy
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
        return $user->hasPermissionTo('inventories.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Inventory  $inventory
     * @return mixed
     */
    public function view(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('inventories.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('inventories.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Inventory  $inventory
     * @return mixed
     */
    public function update(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('inventories.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Inventory  $inventory
     * @return mixed
     */
    public function delete(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('inventories.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  Inventory  $inventory
     * @return mixed
     */
    public function restore(User $user, Inventory $inventory)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Inventory  $inventory
     * @return mixed
     */
    public function forceDelete(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('inventories.delete');
    }
}
