@props(['active' => false])
<a {{ $attributes(['class' => "relative pb-1 text-white group inline-block" ]) }} >
    {{ $slot }}
    <span
        class="absolute bottom-0 left-1/2 -translate-x-1/2 h-0.5 bg-blue-500 rounded-full transition-all duration-300 
        {{ $active ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
    </a>

{{-- 
 @props(['active' => false, 'href' => '#'])

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'group relative inline-block pb-1 font-label-sm text-label-sm transition-colors duration-200 '
            . ($active ? 'text-primary' : 'text-on-surface-variant hover:text-primary')
    ]) }}
>
    {{ $slot }}
    <span
        class="absolute left-1/2 bottom-0 -translate-x-1/2 h-0.5 bg-primary transition-all duration-300 {{ $active ? 'w-full' : 'w-0 group-hover:w-full' }}"
    ></span>
</a> --}}
