@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-txt-200']) }}>
    {{ $value ?? $slot }}
</label>
