<form class="{{ $attributes->get('class') }}" method="{{ $attributes->get('method', 'POST') }}" action="{{ $attributes->get('action') }}"
    {{ $attributes->has('files') ? 'enctype=multipart/form-data' : '' }}>
    @if(in_array($attributes->get('method', 'POST'), ['POST', 'PUT']))
        @csrf
    @endif

    {{ $slot }}
</form>
