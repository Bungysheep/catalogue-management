<?php

namespace App\Policies;

use App\Models\Catalogue;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CataloguePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any catalogues.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->roles()->get()[0]->hasAccess('CATALOGUE', 'read');
    }

    /**
     * Determine whether the user can view the catalogue.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Catalogue  $catalogue
     * @return mixed
     */
    public function view(User $user, Catalogue $catalogue)
    {
        return $user->roles()->get()[0]->hasAccess('CATALOGUE', 'read');
    }

    /**
     * Determine whether the user can create catalogues.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->roles()->get()[0]->hasAccess('CATALOGUE', 'create');
    }

    /**
     * Determine whether the user can update the catalogue.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Catalogue  $catalogue
     * @return mixed
     */
    public function update(User $user, Catalogue $catalogue)
    {
        return $user->roles()->get()[0]->hasAccess('CATALOGUE', 'update');
    }

    /**
     * Determine whether the user can delete the catalogue.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Catalogue  $catalogue
     * @return mixed
     */
    public function delete(User $user, Catalogue $catalogue)
    {
        return $user->roles()->get()[0]->hasAccess('CATALOGUE', 'delete');
    }

    /**
     * Determine whether the user can restore the catalogue.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Catalogue  $catalogue
     * @return mixed
     */
    public function restore(User $user, Catalogue $catalogue)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the catalogue.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Catalogue  $catalogue
     * @return mixed
     */
    public function forceDelete(User $user, Catalogue $catalogue)
    {
        //
    }
}
