{{-- @props(['width' => 90])
<img src="http://picsum.photos/seed/{{ rand(0, 10000) }}/{{ $width }}" alt="" class="rounded-xl"> --}}
@props(['employer', 'width' => 90])
<img  src="{{ str($employer->logo)->startsWith(['http://', 'https://'])
            ? $employer->logo . "/$width"
            : Storage::disk('public')->url($employer->logo) }}" alt="{{ $employer->name }}" class="rounded-xl" width="{{ $width }}">