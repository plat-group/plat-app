
<input name="{{ $name }}" type="{{ $type }}" {{ $attributes->merge(['class' => 'form-control']) }}
data-rule-maxlength="{{ FORM_INPUT_MAX_LENGTH}}" value="{{ Form::getValueAttribute($name, $value) }}">
