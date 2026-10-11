@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm text-white/70 tracking-wider">{{ $job->employer->name }}</div>
    <div class="py-7 font-bold my-auto">
        <h3 class="text-xl group-hover:text-blue-600 transition-colors duration-300">
            <a href="{{ route('jobs.show', ['job' => $job->id, 'slug' => $job->slug]) }}">
                {{ $job->title }}
            </a>
        </h3>
        
        <p class="text-sm mt-4 text-white/70">{{ $job->schedule . " - From " . $job->salary }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div class="flex flex-wrap gap-2">
            @foreach ($job->tags()->take(3)->get() as $tag)
                <x-tag :$tag size="small" />
            @endforeach
        </div>
        
        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>
</x-panel>
