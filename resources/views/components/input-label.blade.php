@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-xs text-sk-darkgreen uppercase tracking-wider mb-2']) }}>
    {{ $value ?? $slot }}
</label>
