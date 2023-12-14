@props(['disabled' => false])

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">{{ $label }}</label>
    <div class="col-md-10">
        <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control']) !!}>

        @if ($messages)
            @foreach ((array) $messages as $message)
                <span class="invalid-feedback"> {{ $message }} </span>
            @endforeach
        @endif
    </div>
</div>
