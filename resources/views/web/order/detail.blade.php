@extends('web.layout')
@section('title_page') {{ $game->name }} @stop
@section('content')
    <!-- Game basic info -->
    @include('web.game._common.item_detail', ['game' => $game])

    <!-- Order content info -->
    @include('web.order._forms.order', ['order' => $order])

    <!-- Uploaded content -->
    @include('web.order._parts.released', ['game' => $game])

    <!-- Content upload form for creator -->
    @includeWhen(Auth::user()->isCreator(), 'web.order._parts.upload_game', ['game' => $game])
@stop
