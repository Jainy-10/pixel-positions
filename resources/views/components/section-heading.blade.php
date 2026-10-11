<div {{ $attributes->merge(['class' => "inline-flex items-center gap-x-2"]) }}>
    <span class="h-2 w-2 bg-blue-500 inline-block"></span>

    <h3 class="font-bold text-lg k">{{ $slot }}</h3>
</div>

