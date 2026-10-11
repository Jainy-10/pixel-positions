@extends('layout.app')

@section('content')


@section('content')
    @php
        $navItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'dashboard',
                'href' => route('recruiter.dashboard'),
                'active' => request()->routeIs('recruiter.dashboard'),
            ],
            [
                'label' => 'Postings',
                'icon' => 'work',
                'href' => '#',
                'active' => false,
            ],
            [
                'label' => 'Candidates',
                'icon' => 'group',
                'href' => route('recruiter.dashboard.candidates'),
                'active' => request()->routeIs('recruiter.dashboard.candidates'),
            ],
            ['label' => 'Analytics', 'icon' => 'bar_chart', 'href' => '#', 'active' => false],
        ];

        $companyName = auth()->user()?->employer->name;
        $companyInitials = strtoupper(substr($companyName, 0, 1));
    @endphp
    <div class="flex flex-col lg:flex-row gap-8">
        @include('employers.partials.sidebar', [
            'navItems' => $navItems,
        ])


        <div class="flex-1 min-w-0">
            <h1 class="text-display-lg-mobile text-on-surface mb-5">Candidates</h1>
            @include('employers.partials.candidates', [
                'applications' => $applications,
            ])
        </div>
    </div>

@endsection
