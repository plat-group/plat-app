@extends('web.layout')
@section('title_page') TEST NEAR @stop
@section('content')
    <x-alert/>
    Test near
    <button id="btn-deposit">Deposite 100 Plats</button>
    <br>
    <button id="btn-deposit-storage">Deposite Storage</button>
    <br>
    <button id="btn-create_fast_game">Create Fast game</button>
    <br>
    <input type="text" id="account" placeholder="yourwallet.testnet">
    <button id="btn-view-balance">View Balance</button>
    <label id="balance">0</label> PLATS
    <br>
    <input type="text" id="gameid" placeholder="Game ID">
    <button id="btn-view-total-deposit">View Total Deposit</button>
    <label id="total-deposit">0</label> PLATS
@stop
@push('js')
    <script src="{{ mix('static/js/web/pages/plats_deposit.js') }}" type="text/javascript"></script>
@endpush
