@extends('web.layout')
@section('css')
<link rel="stylesheet" href="{{mix('static/css/web/pages/myOrder.css')}}">
@endsection
@section('content')
    <div class="container">
        <table class="table w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Creator</th>
                    <th>Order game</th>
                    <th>Order token</th>
                    <th>Token per play</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i <= 10; $i++)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>ebisu</td>
                    <td>Funny Car racing</td>
                    <td>1,000</td>
                    <td>5</td>
                    <td>
                        <div class="options">
                            @if($i === 0)
                            <p class="status mb-0">OK</p>
                            <a href="" title="" class="push">Push to pool</a>
                            @elseif($i === 1)
                            <p class="status mb-0">Ordering</p>
                            <div class="acept-denny">
                                <a href="" title="" class="push me-2">Except</a>
                                <a href="" title="" class="deny">Deny</a>
                            </div>
                            @elseif($i === 2)
                            <p class="status mb-0 ">Paid</p>
                            @elseif($i === 3)

                            <p class="status mb-0">Accepted</p>
                            @else
                            <p class="status mb-0">Creating</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
