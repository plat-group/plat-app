<div class="box-game-item position-relative">
    <div class="thumb-item mb-2">
        <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" class="w-100"/>
    </div>
    <h5 class="mb-0">
        <a href="{{ $item->detail_url }}" title="{{ $item->name }}" class="stretched-link">
            {{ $item->name }}
        </a>
    </h5>
    <div class="text-muted">
        By: <span class="link-red-pink">{{ $item->manager()->name }}</span>
        @if ($item->on_pool && isset($item->campaign))
            <br/> Advertiser's reward: {{ $item->campaign->referral_budget . ' ' . CURRENCY_CODE }}
        @endif
    </div>
</div>
