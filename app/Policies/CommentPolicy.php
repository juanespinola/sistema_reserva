<?php
namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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
        return $user->hasPermissionTo('comments.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
        return $user->hasPermissionTo('comments.show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('comments.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $user->hasPermissionTo('comments.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->hasPermissionTo('comments.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  Comment  $comment
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        return $user->hasPermissionTo('comments.delete');
    }
}
