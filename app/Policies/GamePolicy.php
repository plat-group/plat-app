<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    /**
     * User can push game on the pool
     *
     * @param \App\Models\User $user
     * @param \App\Models\Game $game
     *
     * @return bool
     */
    public function pushToPool(User $user, Game $game)
    {
        return $user->isClient() && $game->isOwner($user->getAuthIdentifier()) && $game->canPushToPool();
    }
}
