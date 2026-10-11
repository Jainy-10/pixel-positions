@extends('layout.app')

@section('title', $job->title . ' at ' . $job->employer->name . ' | Pixel Positions')

@section('content')

    {{-- Job Header --}}
    <header class="mb-12 flex flex-col lg:flex-row md:items-start justify-between gap-6">
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <div
                class="w-20 h-20 rounded bg-surface-container flex items-center justify-center shrink-0 border border-surface-container-highest overflow-hidden">
                @if ($job->employer->logo)
                    <img src="{{ str($job->employer->logo)->startsWith(['http://', 'https://'])
                    ? $job->employer->logo . "/42"
                    : Storage::disk('public')->url($job->employer->logo) }}" alt="{{ $job->employer->name }} logo"
                        class="w-full h-full object-cover">
                @else
                    <span class="material-symbols-outlined text-[40px] text-primary">memory</span>
                @endif
            </div>
            <div>
                <h1
                    class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-surface mb-2">
                    {{ $job->title }}
                </h1>
                <div class="flex flex-wrap items-center gap-4 text-on-surface-variant font-label-sm text-label-sm">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">business</span> {{ $job->employer->name }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">location_on</span> {{ $job->location }}
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">schedule</span> {{ $job->schedule }}
                    </span>

                    @if (true)
                        <span class="flex items-center gap-1 text-primary">
                            <span class="material-symbols-outlined text-[16px]">payments</span>
                            {{-- ${{  number_format($job->salary_min / 1000) }}k - ${{ number_format($job->salary_max / 1000) }}k --}}
                            {{ $job->salary }}
                            per month
                        </span>
                    @endif
                </div>
            </div>
        </div>

        @cannot('edit-job', $job)
            <div class=" flex items-center  sm:flex-row gap-3 md:shrink-0 mt-4 md:mt-0">
                <form action="{{ route('jobs.save', $job->id) }}" method="POST">
                    <button type="submit"
                        class="btn-secondary w-full px-6 py-3 rounded font-label-sm text-label-sm flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">bookmark_add</span>
                        {{ auth()->user()?->savedJobs->contains($job->id) ? 'Unsave' : 'Save' }}
                    </button>
                </form>

                <a href="{{ route('jobs.apply', ['job' => $job, 'slug' => $job->slug]) }}" class="ml-auto">
                    <button type="submit"
                        class="btn-primary px-8 py-3 rounded font-label-sm text-label-sm flex items-center justify-center gap-2">
                        Apply Now <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </a>
            </div>
        @endcannot

        @can('edit-job', $job)
            <div class="mt-8 flex gap-x-5 items-center ">
                {{-- <div  class="flex items-center bg-gray-800 text-white font-bold text-sm tracking-widest uppercase px-8 py-4 rounded-xl hover:bg-gray-700 shadow-lg shadow-gray-800/30 hover:shadow-gray-800/50 transition-all duration-200">
                <a href="{{ route('jobs.edit', $job) }}"
                        class="">
                    Edit Job ⚙️
                </a>
            </div> --}}

                <a href="{{ route('jobs.edit', $job) }}"
                    class="flex items-center bg-gray-800 text-white font-bold text-sm tracking-widest uppercase px-7 py-4 rounded-xl hover:bg-gray-700 shadow-lg shadow-gray-800/30 hover:shadow-gray-800/50 transition-all duration-200">
                    <p>
                        Edit Job
                    </p>

                    <span class="text-xl">⚙️</span>
                </a>

                <!-- Show Edit button if the logged-in user created the job -->
                <x-forms.form action="{{ route('jobs.delete', $job) }}" method="delete" class="flex items-center">
                    <button
                        class="flex items-center bg-red-800/60 text-white font-bold text-sm tracking-widest uppercase px-7 py-4 rounded-xl hover:bg-red-900 shadow-lg shadow-gray-800/30 hover:shadow-gray-800/50 transition-all duration-200">

                        <p class="">Delete Job</p>


                        <span style="font-weight: 300" class="material-symbols-outlined ">
                            delete
                        </span>
                    </button>
                </x-forms.form>
            </div>
        @endcan
    </header>

    {{-- Two Column Layout --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">

        {{-- Left Column: Job Details --}}
        <div class="md:col-span-8 flex flex-col gap-8">

            <section class="glass-card p-6 md:p-8 rounded-lg">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-4">About the Role</h2>
                <div class="text-on-surface-variant space-y-4">
                    {!! nl2br(e($job->description)) !!}
                </div>
            </section>

            @if (true /* $job->responsibilities->isNotEmpty() */)
                <section class="glass-card p-6 md:p-8 rounded-lg">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-4">Key Responsibilities</h2>
                    <ul class="list-none space-y-3 text-on-surface-variant">
                        @foreach ($responsibilities as $responsibility)
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary text-[20px] pb-1">check_circle</span>
                                <span>{{ $responsibility }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            @if (true /*$job->requirements->isNotEmpty() */)
                <section class="glass-card p-6 md:p-8 rounded-lg">
                    <h2 class="font-headline-md text-headline-md text-on-surface mb-4">Requirements</h2>
                    <ul class="list-none space-y-3 text-on-surface-variant">
                        @foreach ($requirements as $requirement)
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-tertiary text-[20px] pb-1">adjust</span>
                                <span>{{ $requirement }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif
        </div>

        {{-- Right Column: Sidebar --}}
        <aside class="md:col-span-4 flex flex-col gap-6">

            {{-- employer Profile --}}
            <div class="glass-card p-6 rounded-lg">
                <h3 class="font-headline-md text-headline-md text-on-surface mb-4 text-[20px]">About
                    {{ $job->employer->name }}</h3>

                @if ($job->employer->cover_picture)
                    <div class="w-full mb-4 rounded-lg overflow-hidden">
                        <img src="{{ Storage::disk('public')->url($job->employer->cover_picture) }}"
                            alt="{{ $job->employer->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-full mb-4 rounded-lg overflow-hidden">
                        <img src="{{ Storage::disk('public')->url('cover/cover_picture_placeholder.webp') }}"
                            alt="{{ $job->employer->name }}" class="w-full h-full object-cover">
                    </div>
                @endif


                <p class="text-on-surface-variant text-sm mb-4">{{ $job->employer->description }}</p>
            </div>

            {{-- Similar Jobs --}}
            @if ($similarJobs->isNotEmpty())
                <div class="glass-card p-6 rounded-lg">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-4 text-[20px]">Similar Jobs</h3>
                    <div class="flex flex-col gap-4">
                        @foreach ($similarJobs as $similarJob)
                        <a href="#{{-- route('jobs.show', $similarJob) --}}"
                            class="group block p-3 rounded hover:bg-surface-container transition-colors border border-transparent hover:border-surface-container-highest">
                            <h4
                                class="font-label-sm text-label-sm text-on-surface group-hover:text-primary transition-colors">
                                {{ $similarJob->title }}</h4>
                            <div class="text-on-surface-variant font-code-xs text-code-xs mt-1">{{ $similarJob->employer->name }}
                                • {{ $similarJob->location }}</div>
                        </a>
                        @if (!$loop->last)
                            <div class="h-px bg-surface-container-highest w-full"></div>
                        @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
@endsection
