<div class="box-game-item position-relative mb-4">
    <div class="thumb-item mb-3">
        <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" class="w-100"/>
    </div>
    <p class="mb-2 box-game-item__title">
        <a href="{{ $item->detail_url }}" title="{{ $item->name }}" class="stretched-link">
            {{ $item->name }}
        </a>
    </p>
    <div class="box-game-item__description fw-bold">
        By <span class="link-primary">{{ $item->manager()->name }}</span> at {{ $item->updated_at->toFormattedDateString() }}
        @if ($item->on_pool && isset($item->campaign))
            <br/> Advertiser's reward: {{ $item->campaign->referral_budget . ' ' . CURRENCY_CODE }}
        @endif
    </div>
</div>
