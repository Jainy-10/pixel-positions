 @php    
        // $navItems = [
        //     ['label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('recruiter.dashboard'), 'active' => true],
        //     ['label' => 'Postings', 'icon' => 'work', 'href' => '#', 'active' => false],
        //     ['label' => 'Candidates', 'icon' => 'group', 'href' => '#', 'active' => false],
        //     ['label' => 'Analytics', 'icon' => 'bar_chart', 'href' => '#', 'active' => false],
        // ];

        $companyName = auth()->user()?->employer->name;
        $companyInitials = strtoupper(substr($companyName, 0, 1));
    @endphp

        <aside class="border-r border-r-gray-500/30 pr-4 lg:w-64 shrink-0">
            <div class="flex flex-col gap-8 lg:sticky lg:top-5">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center text-white font-bold shrink-0">
                        {{ $companyInitials }}
                    </div>
                    
                    <div class="min-w-0">
                        <div class="text-on-surface font-headline-md text-headline-md leading-snug truncate">Recruiter Portal</div>
                        <div class="text-on-surface-variant font-label-sm text-label-sm truncate">{{ $companyName }}</div>
                    </div>
                </div>

                <nav class="flex flex-col gap-1">
                    @foreach($navItems as $item)
                        <a
                            href="{{ $item['href'] }}"
                            class="sidebar-link {{ $item['active'] ? 'sidebar-link--active' : '' }}"
                            @if($item['active']) aria-current="page" @endif
                        >
                            <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="mt-auto flex flex-col gap-3 pt-8 lg:pt-0">
                    <a href="#" class="sidebar-link">
                        <span class="material-symbols-outlined text-[20px]">settings</span>
                        Settings
                    </a>
                    <a href="{{ route('jobs.create') }}" class="btn-primary w-full flex items-center justify-center gap-2 px-4 py-3 rounded font-label-sm text-label-sm">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Quick Post
                    </a>
                </div>

            </div>
        </aside>