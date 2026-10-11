@props(['error' => false])

@if ($error)
    <p class="text-sm text-[#dc2b31] mt-1">{{ $error }}</p>
@endif
