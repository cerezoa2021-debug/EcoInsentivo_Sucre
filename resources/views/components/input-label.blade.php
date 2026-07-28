@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#E7F6FC]']) }}>
    {{ $value ?? $slot }}
</label>
