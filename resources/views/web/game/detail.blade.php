@extends('web.layout')
@section('title_page') {{ $game->name }} @stop
@section('content')
    <!-- Game basic info -->
    @include('web.game._common.item_detail', ['game' => $game])
@stop
