@extends('layout.app')
@section('title', 'Pixel Positions - Find You Next Role')

@section('content')
    <div class="space-y-13">
        <section
            class="job-search-hero relative overflow-hidden bg-[#0b1117] text-center py-30 -mx-margin-mobile md:-mx-margin-desktop -mt-[50px] md:-mt-[50px]">
            <div class="relative z-10">
                <div class="flex justify-center  items-center gap-3">
                    <h1 class="font-bold text-display-lg-mobile md:font-display-lg md:text-display-lg">
                        Let's find you a 
                    </h1>
                    <h1 class="font-['Carattere']  text-blue-600 [text-stroke:1px_blue] [-webkit-text-stroke:1px_blue] text-5xl md:text-7xl relative bottom-2">Great Job</h1>
                </div>

                <x-forms.form action="/search" class="mt-6 mx-auto max-w-2xl px-4 md:px-0">
                    <x-forms.input autocomplete="on"
                        class="px-6 py-4 focus:ring-1 focus:ring-inset focus:ring-blue-600 focus:border-transparent focus:outline-none"
                        :label="false" name="q" placeholder="Web Developer......" />
                </x-forms.form>
            </div>
        </section>

        <section class="py-12 -mt-13 -mx-margin-mobile md:-mx-margin-desktop border-y border-surface-container-highest bg-surface-container-lowest overflow-hidden">
            <div class="max-w-container-max mx-auto px-gutter mb-6 text-center">
                <p class="font-label-sm  -mt-2 text-on-surface-variant/70 uppercase tracking-widest">Trusted by industry leaders
                </p>
            </div>
            <div
                class="flex whitespace-nowrap opacity-50 hover:opacity-100 transition-opacity duration-500 w-[200%] relative">
                <!-- Double the content for seamless looping -->
                <div class="flex items-center justify-around w-1/2 animate-marquee gap-16 px-8">
                    <!-- Placeholder text representing logos for minimalistic tech feel -->
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">NEXUS<span
                            class="text-primary">CORP</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">QUANTUM<span
                            class="text-primary">SYS</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">AERO<span
                            class="text-primary">DYN</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">CYBER<span
                            class="text-primary">SEC</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">DATA<span
                            class="text-primary">GRID</span></span>
                </div>
                <div
                    class="flex items-center justify-around w-1/2 animate-marquee gap-16 px-8 absolute top-0 left-[50%]">
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">NEXUS<span
                            class="text-primary">CORP</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">QUANTUM<span
                            class="text-primary">SYS</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">AERO<span
                            class="text-primary">DYN</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">CYBER<span
                            class="text-primary">SEC</span></span>
                    <span class="font-headline-md text-surface-bright font-bold text-2xl tracking-tighter">DATA<span
                            class="text-primary">GRID</span></span>
                </div>
            </div>
        </section>

        <section class="pt-6">
            <x-section-heading>Featured Jobs</x-section-heading>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8 mt-6">
                @foreach ($featuredJobs as $job)
                    <x-job-card :$job />
                @endforeach
            </div>

        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>


            <div class="mt-6 flex flex-wrap items-center justify-center gap-4">
                @foreach ($tags as $tag)
                    <x-tag :$tag size="large"/>
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Recent Jobs</x-section-heading>

            <div class="mt-6 space-y-6">
                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach

            </div>
        </section>
    </div>
@endsection
