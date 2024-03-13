<?php
namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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
        return $user->hasPermissionTo('customers.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Customer  $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
        return $user->hasPermissionTo('customers.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('customers.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Customer  $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        return $user->hasPermissionTo('customers.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        return $user->hasPermissionTo('customers.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  Customer  $customer
     * @return mixed
     */
    public function restore(User $user, Customer $customer)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Customer  $customer
     * @return mixed
     */
    public function forceDelete(User $user, Customer $customer)
    {
        return $user->hasPermissionTo('customers.delete');
    }
}
