@extends('web.layout')
@section('css')
<link rel="stylesheet" href="{{mix('static/css/web/pages/gameOrder.css')}}">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection
@section('content')
<div class="container mb-3">
    <div class="row">
        <div class="col-6">
            <h1 class="title">DIN SAURS - HUNTER SNIPER SHOOTER</h1>
            <div class="s-content mt-3">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus molestiae exercitationem laudantium saepe perspiciatis nihil eos velit, repellat maxime fugiat corrupti delectus odio id beatae eligendi fuga aspernatur atque illum.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit illo sapiente libero ipsam nobis recusandae ad eum, quae perferendis asperiores! Hic harum illo sapiente laboriosam nam! Maxime aliquid asperiores laudantium!
                </p>
            </div>
        </div>
        <div class="col-6">
            <div class="swiper game-order-slide">
                <div class="swiper-wrapper">
                    @for($i = 0; $i <= 5; $i++) <div class="swiper-slide">
                        <div class="box-img">
                            <img src="https://via.placeholder.com/550x290" alt="">
                        </div>
                </div>
                @endfor
            </div>
        </div>
        <div class="button-control-slide mt-3">
            <div class="swiper-next me-2"><i class="bi bi-chevron-left"></i></div>
            <div class="swiper-prev"><i class="bi bi-chevron-right"></i></div>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class=" row">
        <div class="col-6">
            <form action="" class=" form-order">
                <div class="form-group ">
                    <p class="title">Order token</p>
                    <p class="title_b">* Token amount will be paid after game ok</p>
                    <input type="text" class="form-control form-control-order" placeholder="">
                </div>
                <div class="form-group ">
                    <p class="title">Token for each play</p>
                    <p class="title_b">* Token amount will be paid to creator every time user finish playing game</p>
                    <input type="text" class="form-control form-control-order" placeholder="">
                </div>
                <button class="btn btn-order-submit">Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endsection
