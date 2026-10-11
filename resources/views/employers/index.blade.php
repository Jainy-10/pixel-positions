{{--
    Companies / Employers page.
    Extends the shared app layout (nav + footer live there already, matching
    the reference mockup) so this view only supplies the page content.

    Controller is expected to pass:
      $employers  -> paginator of Employer models
                     (see EmployerController@index for a working example)
--}}
@extends('layout.app')
@section('title', 'Pixel Positions - Find Top Companies')

@section('content')
    {{-- Hero + Search --}}
        <section class="job-search-hero relative overflow-hidden bg-[#0b1117] pb-35 text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-8 -mx-margin-mobile md:-mx-margin-desktop -mt-[50px] md:-mt-[50px]">
        <div class="px-[64px] top-16 relative z-10 max-w-2xl">
            <div class="flex items-center gap-4 relative">
                <h1 class="font-display-lg text-display-lg-mobile md:font-display-lg md:text-display-lg mb-4">
                    Explore Top 
                </h1>
                <h1 class="font-['Carattere']  text-blue-600 [text-stroke:1px_blue] [-webkit-text-stroke:1px_blue] text-5xl sm:text-7xl relative bottom-2">Companies</h1>
            </div>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-8">
                Discover innovative tech employers, view their open roles, and find your next career destination in the
                digital frontier.
            </p>

            <form action="{{ route('employers.index') }}" method="GET" class="relative w-full max-w-xl">
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">
                    search
                </span>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Search for employers, industries..."
                    class="input-dark w-full pl-12 pr-32 py-4 rounded-xl text-on-surface font-body-md text-body-md placeholder-on-surface-variant/50 focus:ring-1 focus:ring-primary-container">
                <button type="submit"
                    class="btn-primary absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2 rounded-lg font-label-sm text-label-sm hover:opacity-90 transition-opacity">
                    Search
                </button>
            </form>
        </div>
    </section>

    {{-- Company Grid --}}
    <section id="employer-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @include('employers.partials.employer-cards', ['employers' => $employers])
    </section>

    {{-- Load More --}}
    @if ($employers->hasMorePages())
        <div class="mt-12 flex justify-center">
            <button id="load-more-btn" type="button" data-next-page-url="{{ $employers->nextPageUrl() }}"
                class="btn-secondary px-8 py-3 rounded-lg font-label-sm text-label-sm hover:bg-surface-container transition-colors flex items-center gap-2">
                <span id="load-more-label">Load More Companies</span>
                <span id="load-more-icon" class="material-symbols-outlined text-sm">expand_more</span>
            </button>
        </div>
    @endif

    <script>
        (function() {
            const btn = document.getElementById('load-more-btn');
            if (!btn) return;

            const grid = document.getElementById('employer-grid');
            const label = document.getElementById('load-more-label');
            const icon = document.getElementById('load-more-icon');

            btn.addEventListener('click', async function() {
                const url = btn.dataset.nextPageUrl;
                if (!url) return;

                btn.disabled = true;
                label.textContent = 'Loading...';
                icon.textContent = 'progress_activity';
                icon.classList.add('animate-spin');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) throw new Error('Request failed');

                    const data = await response.json();

                    grid.insertAdjacentHTML('beforeend', data.html);

                    if (data.next_page_url) {
                        btn.dataset.nextPageUrl = data.next_page_url;
                        btn.disabled = false;
                        label.textContent = 'Load More Companies';
                        icon.textContent = 'expand_more';
                        icon.classList.remove('animate-spin');
                    } else {
                        btn.remove();
                    }
                } catch (error) {
                    label.textContent = 'Something went wrong — retry';
                    icon.textContent = 'refresh';
                    icon.classList.remove('animate-spin');
                    btn.disabled = false;
                }
            });
        })();
    </script>

@endsection
