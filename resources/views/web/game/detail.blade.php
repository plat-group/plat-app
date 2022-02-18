@extends('web.layout')
@section('title_page') {{ $game->name }} @stop
@section('content')
    <!-- Game basic info -->
    @include('web.game._common.item_detail', ['game' => $game])

    <!-- Order content info -->
    @includeWhen(optional(auth()->user())->can('order', $game), 'web.order._forms.order', ['order' => ''])
@stop
