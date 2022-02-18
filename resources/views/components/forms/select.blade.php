<select name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control form-select']) }} aria-label="">
    @foreach($list as $value => $text)
    <option value="{{ $value }}"{{ $selected == $value ? ' selected' : '' }}>
        {{ $text }}
    </option>
    @endforeach
</select>
