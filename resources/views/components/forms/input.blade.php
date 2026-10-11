@props(['label', 'name', 'value' => false, 'helperText' => false])

@php
    $passedClass = $attributes->get('class', '');
    $padding = $passedClass ?: 'px-5 py-3';
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
       'class' => "rounded-xl bg-white/10 border border-white/20 {$padding} px-5 py-3 w-full
             text-white placeholder:text-white/40 outline-none",
                    
        'value' => $value ? $value : old($name)
    ];

    
@endphp

<x-forms.field :$label :$name>
    @if ($helperText)
        <div class="text-sm text-gray-400 pl-5 -mt-1 pb-1 " >{{ $helperText }}</div>
    @endif

    <input {{ $attributes->merge($defaults) }}>
</x-forms.field>
