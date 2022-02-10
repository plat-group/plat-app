@extends('web.layout')
@section('title_page') {{ $game->name }} @stop
@section('content')
    <!-- Game basic info -->
    @include('web.game._common.item_detail', ['game' => $game])

    <!-- Order content info -->
    @includeWhen(optional(auth()->user())->can('order', $game), 'web.order._forms.order', ['order' => $order])

    <!-- Uploaded content -->
    @includeWhen(optional(auth()->user())->can('viewUploadedContent', $game), 'web.order._parts.released', ['game' => $game])

    <!-- Content upload form for creator -->
    @if($order->status != ORDERING_ORDER_STATUS)
        @includeWhen(optional(auth()->user())->can('upload', $game), 'web.order._parts.upload_game', ['game' => $game])
    @endif
@stop
