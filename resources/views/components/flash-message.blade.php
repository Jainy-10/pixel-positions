@props(['type' => 'error', 'message' => 'An orrur occured'])

@php 
    $text = "text-red-400";
    $colors = "border border-red-800/50 bg-red-950/40";
    $symbol = "error";
    
    if ($type == 'success') {
        $text = "text-blue-400";
        $colors = "text-blue-200 border-blue-800/50 bg-blue-950/40";
        $symbol = "check";
    }
    
@endphp

<div class="flex items-center p-4 -mt-5 mb-7 border {{ $colors }} {{ $text }} rounded-lg " role="alert">
    {{-- <svg class="flex-shrink-0 w-5 h-5 me-3 {{ $text }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 6L9 17l-5-5" />
    </svg> --}}
    <span class=" material-symbols-outlined   {{ $colors }} {{ $text }}" role="alert">
        {{ $symbol }}
    </span>
    <span class="sr-only">Info</span>
    <div class="ms-3 text-sm font-medium">
        <strong class="{{ $text }}" > {{ $type }}: </strong> {{ $message }}
    </div>
</div>
