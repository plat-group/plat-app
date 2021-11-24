<?php

namespace App\Policies;

use App\Models\GameTemplate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can order game from market
     *
     * @param \App\Models\User $user
     * @param \App\Models\GameTemplate $game
     *
     * @return bool
     */
    public function order(User $user, GameTemplate $game)
    {
        return true;
        //return $game->on_market && !$game->isAuthor($user->getAuthIdentifier());
    }
}
