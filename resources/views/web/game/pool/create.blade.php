@extends('web.layout')
@section('title_page') {{ trans('web.create_new_game') }}  @stop
@section('content')
    <div class="row justify-content-center">
       <div class="col-12 col-md-10">
           <x-alert/>
           <x-form::open action="{{ route(STORE_GAME_ROUTE, $orderId) }}" files="true" id="sdsadsd" class="create_new_game has_validate">
           <input type="hidden" name="order_id" value="{{$orderId}}">
           <div class="row mb-3">
               <div class="col-md-12">
                <x-form::input name="name" class="form-control-lg rounded-3 bg-white text-black required"
                               placeholder="{{ trans('web.game_name') }}" />
               </div>
           </div>
           <div class="row mb-3">
               <div class="col-md-8 mb-3 mb-md-0">
                   <x-form::textarea name="introduction" :value="old('introduction')" placeholder="{{ trans('web.game_intro') }}" rows="7"
                                     class="form-control-lg bg-white text-black rounded-3" :data-rule-maxlength="FORM_INPUT_MAX_LENGTH"/>
               </div>
               <div class="col-md-4">
                   <div class="box-upload upload-thumb rounded-3" id="thumb_game_box">
                       <label for="thumbGame" class="form-label align-self-center h4 cursor-pointer">
                           {{ trans('web.upload_game_thumb') }}
                       </label>
                       <input class="form-control" type="file" name="thumb" id="thumbGame">
                   </div>
               </div>
           </div>
           <div class="row mt-3 mt-md-5">
               <div class="col-md-3 mx-auto d-grid">
                   <button type="submit" class="btn btn-blue-ribbon text-white btn-lg">
                       {{ trans('web.btn_create_game') }}
                   </button>
               </div>
           </div>
           </x-form::open>
       </div>
   </div>
@stop
@push('css')
    <link href="{{ mix('static/css/web/pages/game_create.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ mix('static/js/web/pages/create_game_template.js') }}" type="text/javascript"></script>
@endpush
