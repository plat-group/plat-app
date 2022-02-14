@extends('web.layout')
@section('title_page')Login with Near wallet @stop
@section('content')
    <input type="hidden" name="user_need" value="{{ $action }}" id="page_action">
@stop
@push('js')
    <script>
        const ROUTES = {
            LOGIN : '{{ route(LOGIN_ROUTE) }}',
            REGISTER : '{{ route(REGISTER_ROUTE) }}',
        };
        LOADING.page();
    </script>
    <script src="{{ mix('static/js/web/pages/near_authentication.js') }}" type="text/javascript"></script>
@endpush
