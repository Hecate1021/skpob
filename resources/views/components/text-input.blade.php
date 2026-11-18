@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 border focus:border-sk-green focus:ring-sk-green rounded-md shadow-sm w-full px-4 py-2 text-gray-800 outline-none transition-colors']) !!}>
