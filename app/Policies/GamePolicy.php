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
    public function createCampaign(User $user, Game $game)
    {
        return $user->isClient() && $game->isOwner($user->getAuthIdentifier()) && $game->canPushToPool();
    }

    /**
     * User can generate link of game
     *
     * @param \App\Models\User $user
     * @param \App\Models\Game $game
     *
     * @return bool
     */
    public function referral(User $user, Game $game)
    {
        return $user->isReferraler() && $game->on_pool;
    }
}
