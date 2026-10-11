@props(['tag', 'size' => 'base'])

@php

    $classes = "bg-white/10 hover:bg-white/25 font-bold transition-colors duration-300 ";

    if ($size === "large") {
        $classes .= ' px-6 py-3 text-md rounded-2xl ';
    }

    if ($size == 'base') {
        $classes .= ' px-5 py-1 text-sm rounded-xl';
    }

    if ($size == 'small') {
        $classes .= ' px-3 py-1 text-2xs rounded-xl';
    }
@endphp

<a href="/tag/{{ $tag->name }}" class="{{ $classes }}">{{ $tag->name }}</a>
