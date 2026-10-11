@extends('layout.app')

@section('title', 'Application Details')

@section('content')

    @php

        $resume = [
            'pages' => 2,
            'download' => '#',
        ];

        $resumeUrl = route('applications.resume', $application);

        $extension = strtolower(pathinfo($application->resume, PATHINFO_EXTENSION));

        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);

        $isPdf = $extension === 'pdf';
    @endphp

    <div class="page-fade">
        <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_320px] gap-8">
            {{-- ========================= --}}
            {{-- Candidate Header --}}
            {{-- ========================= --}}
            <div>
                <div class="glass-card rounded-xl border border-[var(--color-outline-variant)] p-6 mb-8">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-6">

                        {{-- Avatar --}}
                        <div
                            class="w-24 h-24 rounded-xl overflow-hidden bg-[var(--color-surface-container-high)] flex items-center justify-center flex-shrink-0">

                            @if (false)
                                <img src="{{ $applicant['photo'] }}" class="w-full h-full object-cover">
                            @else
                                <div>
                                    <span
                                        class="text-4xl">{{ Str::upper(Str::substr($application->candidate->first_name, 0, 1)) }}
                                    </span>
                                    <span
                                        class="text-4xl">{{ Str::upper(Str::substr($application->candidate->last_name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Candidate Info --}}
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3">
                                <h1 class="text-3xl font-semibold text-[var(--color-on-surface)]">
                                    {{ $application->candidate->getFullName() }}
                                </h1>

                                <span
                                    class="px-3 py-1 rounded-md text-xs bg-red-500/10 text-red-300 border border-red-500/20">
                                    {{ $application->status }}
                                </span>
                            </div>

                            <h2 class="text-xl text-[var(--color-primary)] mt-2">
                                {{ $application->job->title }}
                            </h2>

                            <div class="flex flex-wrap gap-x-8 gap-y-4 mt-5 text-sm text-[var(--color-on-surface-variant)]">
                                {{-- Email --}}
                                <div class="flex items-center gap-2">
                                    {{-- Heroicon Mail --}}
                                    <span class="material-symbols-outlined">
                                        mail
                                    </span>
                                    {{ $application->candidate->email }}
                                </div>

                                {{-- Location --}}
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined">
                                        location_on
                                    </span>
                                    {{ $application->job->location }}
                                </div>

                                {{-- Applied Date --}}
                                <div class="flex items-center gap-2">

                                    <span class="material-symbols-outlined">
                                        schedule
                                    </span>

                                    Applied {{ $application->created_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========================= --}}
                {{-- Resume + Cover Letter --}}
                {{-- ========================= --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Resume --}}
                    <section>
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-3xl font-semibold">
                                Resume
                            </h2>
                        </div>

                        <div
                            class="application-panel rounded-xl overflow-hidden border border-[var(--color-outline-variant)]   h-[65vh] min-h-[550px] max-h-[900px] flex flex-col">

                            {{-- Toolbar --}}
                            <div class="resume-toolbar flex flex-none items-center justify-between px-5 py-3 ">
                                <div class="flex gap-2">
                                    <span class="w-3 h-3 rounded-full bg-zinc-700"></span>
                                    <span class="w-3 h-3 rounded-full bg-zinc-700"></span>
                                    <span class="w-3 h-3 rounded-full bg-zinc-700"></span>
                                </div>

                                {{-- <span class="text-xs text-[var(--color-on-surface-variant)]">
                                    Page 1 of {{ $resume['pages'] }}
                                </span> --}}
                            </div>

                            <div class="flex-1 overflow-auto resume-placeholder h-full ">

                                @if ($isPdf)
                                    <iframe src="{{ $resumeUrl }}" class="w-full h-full border-0" title="Resume">
                                    </iframe>
                                @elseif($isImage)
                                    <div class="h-full overflow-auto flex justify-center p-6">

                                        <img src="{{ $resumeUrl }}" alt="Resume"
                                            class="max-w-full max-h-full object-contain rounded-lg shadow-lg">
                                    </div>
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <div class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 mx-auto text-gray-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12h6m-6 4h6M7 4h7l5 5v11a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                            </svg>

                                            <p class="mt-4 text-lg">
                                                Preview not available
                                            </p>

                                            <a href="{{ $resumeUrl }}" target="_blank"
                                                class="btn-primary inline-block mt-5 px-5 py-2 rounded-lg">
                                                Download Resume
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>

                    {{-- Cover Letter --}}
                    <section>
                        <h2 class="text-3xl font-semibold mb-4">
                            Cover Letter
                        </h2>

                        <div
                            class="application-panel h-[65vh] min-h-[550px] max-h-[900px] overflow-auto document-scroll overflow-y-auto">
                            <div class="p-8 whitespace-pre-line leading-9 text-[var(--color-on-surface-variant)]">
                                {{ $application->cover_letter }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            @include('partials.application-sidebar')
        </div>
    </div>
@endsection
