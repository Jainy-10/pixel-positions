@php
    $originalMethod = strToUpper($attributes->get('method', 'GET'));

    $formMethod = in_array($originalMethod,  ['GET', 'POST']) 
        ? $originalMethod
        : 'POST';

    $passedClass = $attributes->get('class', '');
    $marginWidth = $passedClass ?: 'mx-auto max-w-xl';

@endphp

<form method="{{ $formMethod }}" {{ $attributes->except('method', 'class')->merge(["class" => "{$marginWidth} space-y-6"]) }}>
    @if ($formMethod == 'POST')
        @csrf
    @endif

    @if (! in_array($originalMethod, ['GET', 'POST']))
        @method($originalMethod)
    @endif

    {{ $slot }}
</form>
