@props(['value'])

<label {{ $attributes->merge(['class' => 'col-md-2 col-form-label']) }}>
    {{ $value ?? $slot }}
</label>
