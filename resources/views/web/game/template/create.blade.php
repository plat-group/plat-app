@extends('web.layout')
@section('title_page') {{ trans('web.create_new_game') }}  @stop
@section('content')
    <div class="row justify-content-center">
       <div class="col-12 col-md-10">
           <x-alert/>
           <x-form::open action="{{ route(STORE_TEMPLATE_GAME_ROUTE) }}" files="true" class="create_new_game has_validate">
           <div class="row mb-3">
               <div class="col-md-12">
                <x-form::input name="name" class="form-control-lg rounded-3 required"
                               placeholder="{{ trans('web.game_name') }}" />
               </div>
           </div>
           <div class="row mb-3">
               <div class="col-md-8 mb-3 mb-md-0">
                   <x-form::textarea name="introduction" placeholder="{{ trans('web.game_intro') }}" rows="7" class="form-control-lg rounded-3"/>
               </div>
               <div class="col-md-4">
                   <div class="box-upload upload-thumb rounded-3">
                       <label for="thumbGame" class="form-label align-self-center h4 cursor-pointer">
                           {{ trans('web.upload_game_thumb') }}
                       </label>
                       <input class="form-control" type="file" name="thumb" id="thumbGame">
                   </div>
               </div>
           </div>
           <div class="row mb-3">
               <div class="col-md-12">
                   <div class="box-upload upload-file rounded-3">
                       <label for="fileGame" class="form-label align-self-center h4 cursor-pointer">
                           {{ trans('web.upload_game_file') }}
                       </label>
                       <input class="form-control" type="file" name="game_file" id="fileGame">
                   </div>
               </div>
           </div>
           <div class="row mt-3 mt-md-5">
               <div class="col-md-3 mx-auto d-grid">
                   <button type="submit" class="btn btn-red-pink btn-lg">
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
