@extends('layout.app')

@section('title', 'Recruiter Dashboard | Pixel Position')

@section('content')
    @php
        $navItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'dashboard',
                'href' => route('recruiter.dashboard'),
                'active' => request()->routeIs('recruiter.dashboard'),
            ],
            ['label' => 'Postings', 'icon' => 'work', 'href' => '#', 'active' => false],
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

        {{-- Main dashboard content --}}
        <div class="flex-1 min-w-0">

            {{-- Page header --}}
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-10">
                <div>
                    <h1 class="font-display-lg text-display-lg text-on-surface mb-2">Overview</h1>
                    <p class="text-on-surface-variant font-body-md text-body-md">
                        Here's what's happening with your hiring pipeline today.
                    </p>
                </div>
            </div>

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter mb-10">
                @foreach ($stats as $stat)
                    <div class="glass-card rounded-lg p-6">
                        <div class="flex items-start justify-between mb-6">
                            <span class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wide">
                                {{ $stat['label'] }}
                            </span>
                            <div class="icon-tile">
                                <span class="material-symbols-outlined text-[20px]">{{ $stat['icon'] }}</span>
                            </div>
                        </div>
                        <div class="text-on-surface font-bold text-4xl mb-2">
                            {{ $stat['value'] }}
                        </div>
                        <div class="flex items-center gap-1 text-primary font-label-sm text-label-sm">
                            <span class="material-symbols-outlined text-[16px]">{{ $stat['trend_icon'] }}</span>
                            {{ $stat['trend'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Recent Applicants --}}
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-headline-md text-headline-md text-on-surface">Recent Applicants</h2>
                <a href="{{ route('recruiter.dashboard.candidates') }}"
                    class=" text-primary font-label-sm text-label-sm flex items-center gap-1 hover:underline ">
                    View All <span style="font-size: 16px;" class=" material-symbols-outlined  ">arrow_forward</span>
                </a>
            </div>

            
            @include('employers.partials.candidates', [
                'applications' => $applications,
            ])

        </div>
    </div>

@endsection
