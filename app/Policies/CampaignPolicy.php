<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * @param \App\Models\User $user
     * @param \Illuminate\Database\Eloquent\Model $belong
     *
     * @return bool
     */
    public function create(User $user, Model $belong)
    {
        return true;
    }
}
