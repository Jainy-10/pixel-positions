@extends('layout.app')

@section('title', 'Pixel Positions - Engineering the Future of Work')

@section('content')
    <!-- Main Content Canvas -->
    <main
        class="flex-grow  pb-24  max-w-container-max mx-auto w-full flex flex-col gap-y-24 md:gap-y-[120px]">

        <!-- Hero Section -->
        <section class="job-search-hero relative overflow-hidden bg-[#0b1117] flex flex-col items-center text-center pt-25  mx-auto space-y-6 md:space-y-8 -mx-margin-mobile md:-mx-margin-desktop -mt-[50px] md:-mt-[50px]">
            
            <div class="flex gap-3 items-center">
                <h1 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-on-surface">
                    Engineering the 
                </h1>
                <h1 class="font-['Carattere'] [text-stroke:1px_blue] [-webkit-text-stroke:1px_blue] text-primary-container text-6xl md:text-8xl ">Future</h1>
                <h1 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-on-surface">
                    Of  Work 
                </h1>
            </div>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">
                We are building the definitive ecosystem for tech professionals and industry leaders. A high-performance
                platform designed to accelerate careers, streamline recruitment, and drive innovation across the global
                technology landscape.
            </p>
            <div class="w-100 sm:w-150 mt-8 md:mt-12 rounded-xl overflow-hidden border border-[#1A1A1A]">
                <img class="w-full h-full object-cover"
                    alt="Futuristic high-tech workspace illuminated by electric blue lighting" {{-- src="https://placehold.co/1600x900/050505/b3c5ff/png?text=TechNexus+Infrastructure" --}}
                    src="{{ Storage::disk('public')->url('cover/about-cover.jpg') }}" />

            </div>
        </section>

        <!-- Bento Grid: For Candidates & Employers -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-gutter">

            <!-- For Candidates Column -->
            <div class="flex flex-col gap-gutter">
                <div class="mb-2 md:mb-4">
                    <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-container">person_search</span>
                        For Candidates
                    </h2>
                </div>
                <div class="glass-card rounded-xl p-6 md:p-8 h-full flex flex-col justify-between gap-6">
                    <div>
                        <span class="material-symbols-outlined text-3xl text-secondary mb-4 block">work_history</span>
                        <h3 class="font-headline-md text-body-lg font-semibold text-on-surface mb-2">Seamless Opportunities
                        </h3>
                        <p class="text-on-surface-variant text-sm">Access a curated pipeline of high-impact roles. Our
                            algorithm matches your specific technical stack and career velocity with roles that matter.</p>
                    </div>
                    <div class="w-full h-40 rounded-lg overflow-hidden border border-[#262626]">
                        <img class="w-full h-full object-cover"
                            alt="Candidate matching dashboard in dark mode with blue accents"
                            src="{{ Storage::disk('public')->url('cover/cover-2.jpg') }}" />
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-gutter">
                    <div class="glass-card rounded-xl p-6">
                        <span class="material-symbols-outlined text-2xl text-secondary mb-2 block">quickreply</span>
                        <h4 class="font-bold text-on-surface text-sm mb-1">Real-time Tracking</h4>
                        <p class="text-on-surface-variant text-xs">Never guess where you stand. Instant status updates on
                            applications.</p>
                    </div>
                    <div class="glass-card rounded-xl p-6">
                        <span class="material-symbols-outlined text-2xl text-secondary mb-2 block">rocket_launch</span>
                        <h4 class="font-bold text-on-surface text-sm mb-1">One-Click Apply</h4>
                        <p class="text-on-surface-variant text-xs">Bypass repetitive forms with a unified technical profile.
                        </p>
                    </div>
                </div>
            </div>

            <!-- For Employers Column -->
            <div class="flex flex-col gap-gutter">
                <div class="mb-2 md:mb-4">
                    <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-container">business_center</span>
                        For Employers
                    </h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-gutter">
                    <div class="glass-card rounded-xl p-6">
                        <span class="material-symbols-outlined text-2xl text-primary-container mb-2 block">group_add</span>
                        <h4 class="font-bold text-on-surface text-sm mb-1">Targeted Reach</h4>
                        <p class="text-on-surface-variant text-xs">Deploy job posts directly to verified, active tech
                            professionals.</p>
                    </div>
                    <div class="glass-card rounded-xl p-6">
                        <span
                            class="material-symbols-outlined text-2xl text-primary-container mb-2 block">event_available</span>
                        <h4 class="font-bold text-on-surface text-sm mb-1">Workflow Integration</h4>
                        <p class="text-on-surface-variant text-xs">Automate scheduling and manage candidates in one view.
                        </p>
                    </div>
                </div>
                <div class="glass-card rounded-xl p-6 md:p-8 h-full flex flex-col justify-between gap-6 mt-auto">
                    <div>
                        <span class="material-symbols-outlined text-3xl text-primary-container mb-4 block">analytics</span>
                        <h3 class="font-headline-md text-body-lg font-semibold text-on-surface mb-2">Data-Driven Hiring</h3>
                        <p class="text-on-surface-variant text-sm">Utilize advanced analytics to track hiring velocity,
                            source quality, and optimize your recruitment pipeline for maximum efficiency.</p>
                    </div>
                    <div class="w-full h-40 rounded-lg overflow-hidden border border-[#262626]">
                        <img class="w-full h-full object-cover"
                            alt="Dark-themed hiring analytics dashboard with neon blue charts"
                            src="{{ Storage::disk('public')->url('cover/dashboard.jpg') }}" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Vision Section -->
        <section class="relative glass-card rounded-xl p-8 md:p-16 overflow-hidden flex flex-col items-center text-center">
            <!-- Decorative gradient line -->
            <div
                class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary-container to-transparent opacity-50">
            </div>
            <span class="material-symbols-outlined text-4xl md:text-5xl text-primary-container mb-6">visibility</span>
            <h2 class="font-headline-md text-headline-md text-on-surface mb-6">Our Vision</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl leading-relaxed">
                TechNexus exists to close the gap between exceptional talent and transformative projects. We believe that by
                removing friction from the hiring process and providing transparent, data-rich tools, we can empower the
                global tech ecosystem to build faster, smarter, and more inclusively. Our commitment is to remain the
                authoritative foundation where the future of work is engineered.
            </p>
        </section>
    </main>
@endsection
