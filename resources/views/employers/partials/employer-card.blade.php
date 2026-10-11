{{--
    Single employer card.
    Expects an $employer model with (adjust field names to match your Employer table):
      - name
      - logo                 (storage path, nullable -> falls back to an icon)
      - description / about
      - open_positions_count (e.g. via ->withCount('jobs as open_positions_count'))
      - slug or id           (for the "View Jobs" link)
--}}
<div class="glass-card rounded-xl p-6 flex flex-col h-full relative overflow-hidden group">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-container to-secondary-container opacity-0 group-hover:opacity-100 transition-opacity"></div>

    <div class="flex items-start justify-between mb-4">
        <div class="w-16 h-16 rounded-lg bg-surface-container-high flex items-center justify-center border border-surface-container-highest overflow-hidden">
            @if(!empty($employer->logo))
                {{-- <img
                    src="{{ asset('storage/' . $employer->logo) }}"
                    alt="{{ $employer->name }} logo"
                    class="w-full h-full object-contain"
                    loading="lazy"
                > --}}

                <img  src="{{ str($employer->logo)->startsWith(['http://', 'https://'])
                    ? $employer->logo . "/42"
                    : Storage::disk('public')->url($employer->logo) }}" alt="{{ $employer->name }}" 
                    loading="lazy"
                    class="w-full h-full object-contain"
                >

            @else
                <span class="material-symbols-outlined text-3xl text-primary" style="font-variation-settings: 'FILL' 1;">business</span>
            @endif
        </div>

        <span class="bg-primary-container/10 text-primary-container px-3 py-1 rounded-[9999px] font-label-sm text-label-sm border border-primary-container/20 whitespace-nowrap">
            {{ $employer->open_positions_count ?? 0 }} Open {{ Str::plural('Position', $employer->open_positions_count ?? 0) }}
        </span>
    </div>

    <h3 class="font-headline-md text-headline-md mb-2 truncate" title="{{ $employer->name }}">
        {{ $employer->name }}
    </h3>

    <p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow line-clamp-3">
        {{ $employer->description }}
    </p>

    <a
        href="employers/{{ $employer->id }}/jobs"
        class="btn-secondary w-full py-2 rounded-lg font-label-sm text-label-sm text-center hover:bg-surface-container transition-colors group-hover:border-primary-container group-hover:text-primary"
    >
        View Jobs
    </a>
</div>