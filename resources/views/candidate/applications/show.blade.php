@extends('layout.app')

@section('title', 'Application Status')

@section('content')
    @php
        // Expecting a $application array/model with a `status` of: pending | interview | accepted
        $status = $application['status'] ?? 'pending';

        // Order matters — index drives which steps are "done" vs "upcoming"
        $steps = [
            ['key' => 'pending',   'label' => 'Applied',   'icon' => 'check'],
            ['key' => 'interview', 'label' => 'Interview', 'icon' => 'group'],
            ['key' => 'accepted',  'label' => 'Accepted',  'icon' => 'handshake'],
          
        ];

        $isRejected = $status === 'rejected';

        $statusOrder   = array_column($steps, 'key');
        $currentIndex  = array_search($status, $statusOrder);
        $currentIndex  = ($currentIndex === false || $isRejected) ? -1 : $currentIndex;
        $progressWidth = $currentIndex <= 0 ? 0 : ($currentIndex / (count($steps) - 1)) * 100;

        $badges = [
            'pending'   => ['label' => 'Under Review',    'class' => 'status-badge--pending'],
            'interview' => ['label' => 'Interview',  'class' => 'status-badge--action'],
            'accepted'  => ['label' => 'Accepted',         'class' => 'status-badge--accepted'],
            'rejected'  => ['label' => 'Declined',        'class' => 'status-badge--rejected'],

        ];
        $badge = $badges[$status] ?? $badges['pending'];
    @endphp

    
        <div
            class="w-full max-w-container-max grid grid-cols-1 md:grid-cols-12 gap-gutter"
            data-application-status="{{ $status }}"
        >
            {{-- Header --}}
            <div class="md:col-span-12 mb-8">
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                    Application Status
                </p>
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-surface mb-2">
                    {{ $application->job->title }}
                </h1>
                <div class="application-meta font-body-md text-body-md">
                    <span class="material-symbols-outlined text-[18px]">business</span>
                    <span>{{ $application->job->employer->name ?? 'QuantumCore Labs' }}</span>
                    <span class="text-outline mx-2">&bull;</span>
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span>{{ $application->job->location ?? 'San Francisco, CA (Hybrid)' }}</span>
                </div>
            </div>

            {{-- Main column --}}
            <div class="md:col-span-8 flex flex-col gap-6">

                {{-- Status stepper card --}}
                <div class="application-panel p-6" id="status-card">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-headline-md text-headline-md text-on-surface">Current Status</h2>
                        <span id="status-flag" class="status-badge {{ $badge['class'] }}">
                            <span class="status-badge__dot"></span>
                            {{ $badge['label'] }}
                        </span>
                    </div>

                    <div class="relative flex justify-between items-center w-full mt-8 mb-4">
                        <div class="stepper-track absolute inset-0 top-1/2 h-[2px] -z-10 -translate-y-1/2"></div>
                        <div
                            id="stepper-progress"
                            class="stepper-progress absolute inset-0 top-1/2 h-[2px] -z-10 -translate-y-1/2"
                            style="width: {{ $progressWidth }}%"
                        ></div>

                        @foreach ($steps as $index => $step)
                            @php
                                $state = $index < $currentIndex ? 'done' : ($index === $currentIndex ? 'active' : 'upcoming');
                                $icon  = $state === 'done' ? 'check' : $step['icon'];
                                $labelClass = match ($state) {
                                    'active' => 'text-primary-container font-semibold',
                                    'done'   => 'text-on-surface',
                                    default  => 'text-on-surface-variant',
                                };
                            @endphp
                            <div class="flex flex-col items-center" data-step="{{ $step['key'] }}">
                                <div class="stepper-node stepper-node--{{ $state }} mb-2">
                                    <span class="material-symbols-outlined text-[16px]">{{ $icon }}</span>
                                </div>
                                <span class="font-label-sm text-label-sm {{ $labelClass }}">
                                    {{ $step['label'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Employer instructions --}}
                <div class="application-panel p-6 border-l-4 border-l-primary-container">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-container">info</span>
                        Instructions from Employer
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-4">
                        {{ $application['instructions']
                            ?? 'Thank you for your interest in QuantumCore Labs. Please complete the technical assessment sent to your email by Friday at 5:00 PM PST. This assessment will test your knowledge in machine learning algorithms and Python.' }}
                    </p>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="md:col-span-4 flex flex-col gap-6">
                <div class="application-panel p-6">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-4  border-b border-b-[#424656] pb-2">
                        Application Details
                    </h3>
                    <dl class="flex flex-col gap-4">
                        <div>
                            <dt class="font-label-sm text-label-sm text-on-surface-variant mb-1">Applicant Name</dt>
                            <dd class="font-body-md text-body-md text-on-surface">
                                {{ $application->candidate->getFullname() ?? 'Alex Mercer' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="font-label-sm text-label-sm text-on-surface-variant mb-1">Contact Email</dt>
                            <dd class="font-body-md text-body-md text-on-surface flex flex-wrap items-center gap-2">
                                <span id="applicant-email" class="break-all">{{ $application->candidate->email ?? 'alex.mercer@example.com' }}</span>
                                <button type="button" id="copy-email-btn" class="icon-button shrink-0" title="Copy email">
                                    <span class="material-symbols-outlined text-[16px]">content_copy</span>
                                </button>
                            </dd>
                        </div>
                        <div>
                            <dt class="font-label-sm text-label-sm text-on-surface-variant mb-1">Applied Date</dt>
                            <dd class="font-body-md text-body-md text-on-surface">
                                {{ $application->created_at ?? 'October 24, 2024' }}
                            </dd>
                        </div>
                        <div class="pt-2">
                            <dt class="font-label-sm text-label-sm text-on-surface-variant mb-2">Attached Documents</dt>
                            <dd>
                                <div class="flex items-center gap-3 p-3 bg-surface-container-low border border-surface-container-highest rounded">
                                    <span class="material-symbols-outlined text-on-surface-variant">description</span>
                                    <span class="font-label-sm text-label-sm text-on-surface truncate">
                                        {{ $application->resume_original_name ?? 'Alex_Mercer_Resume_2024.pdf' }}
                                    </span>
                                </div>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var copyBtn = document.getElementById('copy-email-btn');

            if (copyBtn) {
                copyBtn.addEventListener('click', function () {
                    var email = document.getElementById('applicant-email').textContent.trim();
                    var icon = copyBtn.querySelector('span');

                    navigator.clipboard.writeText(email).then(function () {
                        icon.textContent = 'check';
                        setTimeout(function () {
                            icon.textContent = 'content_copy';
                        }, 1500);
                    });
                });
            }
        });
        
    </script>
@endpush