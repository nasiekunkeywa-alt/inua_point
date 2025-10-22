@props(['name','value' => '', 'type' => 'text'])
<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" {{ $attributes->merge(['class' => 'form-control']) }}>