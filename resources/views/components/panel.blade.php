@php
    $classes = 'p-4 bg-white/[0.02] rounded-xl border border-white/[0.1] hover:border-blue-800 hover:bg-white/[0.04] group transition-all duration-300';
@endphp

    <div {{ $attributes(['class' => $classes])  }}>
        
        {{ $slot }}
    </div>
<div class="hidden bg-[#0000004f]"></div>