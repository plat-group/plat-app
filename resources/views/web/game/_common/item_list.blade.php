<div class="box-game-item position-relative mb-4">
    <div class="thumb-item mb-3">
        <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" class="w-100"/>
    </div>
    <p class="mb-2 box-game-item__title">
        <a href="{{ $item->detail_url }}" title="{{ $item->name }}" class="stretched-link">
            {{ $item->name }}
        </a>
    </p>
    <div class="box-game-item__description fw-bold" style="font-size: 14px;">
        <div class="row">
            <div class="col-md-2">
                <img src="{{$item->manager()->avatar ? '/upload/' . $item->manager()->avatar : '/static/images/web/user_avatar.png'}}" alt="" class="rounded-circle" style="width: 34px; height: 34px;"/>
            </div>
            <div class="col-md-10 mt-1 px-1">
                <!-- {{$item->campaign}} -->
                by <span class="link-primary">{{ $item->manager()->name }}</span> at {{ $item->updated_at->toFormattedDateString() }}
                @if ($item->on_pool && isset($item->campaign))
                    <div class="mt-1">
                        <img src="/static/images/web/total_reward.svg" />
                        <span class="mx-1">
                        {{ round($item->campaign->total_budget) . ' ' . TOKEN_SYMBOL }}
                        </span>
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <img src="/static/images/web/referral_reward.svg" />
                                <span class="ms-1">
                                    {{ round($item->campaign->referral_budget) . ' ' . TOKEN_SYMBOL }} /
                                </span>
                                <img src="/static/images/web/play_game.svg" />
                            </div>
                            <div class="col-md-6">
                                <img src="/static/images/web/user_reward.svg" />
                                <span class="ms-1">
                                    {{ round($item->campaign->user_budget) . ' ' . TOKEN_SYMBOL }} /
                                </span>
                                <img src="/static/images/web/play_game.svg" />
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <br />
    </div>
</div>
