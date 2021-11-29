@extends('web.layout')
@section('title_page') {{ trans('web.play_game') }} @stop
@section('content')
    <x-form::open :action="route(FINISH_GAME_ROUTE, $game->id)">
        <x-form::input type="hidden" name="game_id" :value="$game->id"/>
        <x-form::input type="hidden" name="referral_id" :value="$referral"/>
        <x-form::input type="hidden" name="campaign_id" :value="$game->campaign->id"/>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn btn-primary btn-lg text-uppercase">finish game</button>
        </div>
    </x-form::open>
@stop
