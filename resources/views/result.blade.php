@extends('layout.app')
@section('title', 'Pixel Positions - ' . $heading)

@section('content')
    <x-page-heading>
        {{ $heading }}
    </x-page-heading>

    <div class="mt-6 space-y-6 ">
        @foreach ($jobs as $job)
            <x-job-card-wide :$job />
        @endforeach
    </div>

    @if ($jobs->isEmpty())
        <div class="text-2xl text-center my-30">{{ request()->is('search', 'tag/*') ? 'Not Found' : 'You have not Saved any Jobs' }}
        </div>
    @endif
@endsection
