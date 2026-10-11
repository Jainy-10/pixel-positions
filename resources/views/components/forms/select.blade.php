@props(['label', 'name'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/20 px-5 py-4 w-full
                    text-white appearance-none cursor-pointer focus:outline-none 
                    focus:ring-2 focus:ring-white/30 focus:border-white/40
                    [&>option]:bg-zinc-900 [&>option]:text-white'
    ];
@endphp

<x-forms.field :$label :$name>
    <div class="relative">
        <select {{ $attributes($defaults) }}>
            {{ $slot }}
        </select>
        {{-- Custom dropdown arrow since appearance-none removes the default --}}
        {{-- <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
            <svg class="h-4 w-4 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div> --}}
    </div>
</x-forms.field>
