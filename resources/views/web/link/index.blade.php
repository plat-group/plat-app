@extends('web.layout')
@section('css')
<link rel="stylesheet" href="{{mix('static/css/web/pages/link.css')}}">
@endsection
@section('content')
<div class="container d-flex align-items-center justify-content-end">
    <a href="" class="referral_m me-2">market</a>
    <a href="" class="referral_m">my game</a>
</div>
<div class="container mb-3 pt-5">
    <div class="row">
        <div class="col-12">
            <div class="main-link">
                <p class="title">Affiliate link</p>
                <div class="box-link">
                    <p class="link form-control mb-0 me-4">http://xxxxxxxxxxxxxxxxxx.xxxxxxxxxxxxxx?0xxxxxx</p>
                    <p class="btn btn-copy mb-0">Copy</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

