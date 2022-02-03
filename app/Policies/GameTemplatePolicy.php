<?php

namespace App\Policies;

use App\Models\GameTemplate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->isCreator();
    }

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
        return $game->on_market && $user->isClient() || $game->isOwner($user->getAuthIdentifier());
    }

    /**
     * Determine whether the user can upload content of game (Only creator)
     *
     * @param \App\Models\User $user
     * @param \App\Models\GameTemplate $game
     *
     * @return bool
     */
    public function upload(User $user, GameTemplate $game)
    {
        return $game->isOwner($user->getAuthIdentifier());
    }

    /**
     * Determine whether the user can upload content of game
     * Currently same with permission to view order content
     *
     * @param \App\Models\User $user
     * @param \App\Models\GameTemplate $game
     *
     * @return bool
     */
    public function viewUploadedContent(User $user, GameTemplate $game)
    {
        return $this->order($user, $game);
    }
}
