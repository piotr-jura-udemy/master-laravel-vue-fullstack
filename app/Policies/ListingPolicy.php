<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    public function before(?User $user, $ability)
    {
        if ($user?->is_admin /*&& $ability === 'update'*/) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Listing $listing)
    {
        if ($listing->by_user_id === $user?->id) {
            return true;
        }

        return $listing->sold_at === null;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Listing $listing)
    {
        return $listing->sold_at === null
            && ($user->id === $listing->by_user_id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Listing $listing)
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Listing $listing)
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Listing $listing)
    {
        return $user->id === $listing->by_user_id;
    }
}
