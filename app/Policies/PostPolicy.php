<?php

namespace App\Policies;

use Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function canEdit(\App\User $user, \App\Article $article)
    {
        if (! Gate::allows('edit-post')) {
            return $user->owns($article);
        }
        else
        {
            return TRUE;
        }
    }

    public function canDelete(\App\User $user, \App\Article $article)
    {
        return FALSE;
    }
}
