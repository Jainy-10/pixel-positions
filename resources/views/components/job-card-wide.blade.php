{{-- Using Flexbox --}}
@props(['job'])

<x-panel class="flex gap-x-6">    
    <div class="flex items-center">
        <x-employer-logo :employer="$job->employer" :width="100"/>
    </div>
    
    <div class="flex-1 flex flex-col">
        <a href="" class="text-sm text-gray-400">{{ $job->employer->name }}</a>
        
        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-700 transition-colors duration-300">
            <a href="{{ route('jobs.show', ['job' => $job->id, 'slug' => $job->slug]) }}" >
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-gray-400 text-sm mt-auto">{{ $job->schedule . ' - From ' . $job->salary }}</p>
    </div>
 
    <div>
        @foreach ($job->tags as $tag)
            <x-tag :$tag size='small'/>
        @endforeach
    </div>
</x-panel>

{{-- Using Grid --}}
{{-- <div class="p-4 bg-white/5 rounded-xl grid grid-cols-[auto_1fr_auto] gap-x-6 items-start">
    
    <!-- Column 1: Image -->
    <div class="self-center">
        <img src="http://placehold.co/90x90/white/blue" alt="" class="rounded-xl">
    </div>

    <!-- Column 2: Content -->
    <div class="self-center">
        <a href="" class="text-sm text-gray-400">Laracast</a>
        <h3 class="font-bold text-lg">Full Stack Developer</h3>
        <p class="text-sm">Full time - From $60,000</p>
    </div>

    <!-- Column 3: Tags (Side-by-side at the top) -->
    <div class="flex flex-wrap gap-2">
        <x-tag>Tag</x-tag>
        <x-tag>Tag</x-tag>
        <x-tag>Tag</x-tag>
    </div>

</div> --}}