@extends('web.layout')
@section('css')
<link rel="stylesheet" href="{{mix('static/css/web/pages/myOrder.css')}}">
<link rel="stylesheet" href="{{mix('static/css/web/pages/myGame.css')}}">
@endsection
@section('content')
    <div class="container">

        <div class="total-earned-token mb-4">
            <p class="title">Your total earned token</p>
            <p class="box-token">23,300 Plt</p>
        </div>

        <table class="table w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Game</th>
                    <th>Earned token</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i <= 10; $i++)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>Toyoya</td>
                    <td>Funny Car racing</td>
                    <td>10</td>
                    <td>11/10/2021</td>

                </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
