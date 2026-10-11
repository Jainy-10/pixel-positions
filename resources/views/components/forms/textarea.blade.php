@props(['label', 'name', 'value' => false])

@php
    $defaults = [
        'name' => $name,
        'id' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full',
    ];

@endphp

<x-forms.field :$label :$name >
    <textarea {{ $attributes($defaults) }} >{{ $slot }}</textarea>
</x-forms.field>