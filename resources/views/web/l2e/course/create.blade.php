@extends('web.layout')
@section('title_page') Plats L2E - Create course @stop
@section('content')
<div class="row">
    <div class="col-12">
        <x-alert/>
    </div>
    <div class="col-12 col-md-10 mx-md-auto inner-box bg-mauve-400 rounded-3 p-4 mb-4">
        @include('web.l2e.course._form')
    </div>

</div>
@stop
