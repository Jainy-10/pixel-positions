<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechNexus – Find Your Next Role')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Geist:wght@400;500&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased min-h-screen flex flex-col bg-background text-on-surface font-body-md text-body-md"
      x-data="{ mobileMenuOpen: false }">

    {{-- Top Nav --}}
    <nav class="bg-background w-full top-0 sticky border-b border-surface-container-highest z-50">
        <div
            class="flex justify-between items-center px-margin-mobile min-[1200px]:px-margin-desktop py-2 max-w-container-max mx-auto">
            <div class="flex items-center gap-8">
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="w-25" alt="TechNexus">
                </a>

            </div>

            <div class="hidden min-[750px]:flex justify-center py-2 gap-6 font-semibold">
                <x-nav-link href="/" :active="request()->routeIs(['home', 'jobs.*'])">Find Jobs</x-nav-link>
                <x-nav-link href="{{ route('employers.index') }}" :active="request()->routeIs('employers.*')">Companies</x-nav-link>
                <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
                <x-nav-link href="/saved-jobs" :active="request()->is('saved-jobs')">Saved Jobs</x-nav-link>
            </div>

            <div class="hidden min-[750px]:flex items-center gap-4">
                @guest
                <a href="{{ route('login') }}"
                        class="text-primary hover:text-primary/80 transition-colors duration-200 font-label-sm text-label-sm">
                        Sign In
                    </a>
                @endguest
                <div>
                    <a href="{{ route('jobs.create') }}"
                        class="px-4 py-2 btn-primary rounded font-label-sm text-label-sm">
                        Post a Job
                    </a>
                </div>

                @auth
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <!-- Profile Trigger Button -->
                        <button @click="open = !open"
                            class="flex items-center text-on-surface-variant hover:text-primary transition-colors focus:outline-none mt-1"
                            aria-haspopup="true" :aria-expanded="open">
                            <span style="font-size: 2rem; font-weight: 300;"
                            class="material-symbols-outlined select-none pointer-events-none">
                            account_circle
                        </span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 rounded bg-surface-container border border-surface-container-highest shadow-lg py-1 z-50 origin-top-right focus:outline-none"
                            style="display: none;">
                            <!-- Custom Navigation Links -->
                            <a href="{{ route('users.edit') }}"
                                class="block px-4 py-2 font-label-sm text-label-sm text-on-surface hover:bg-surface-container-high transition-colors">
                                My Profile
                            </a>
    
                            @if (auth()?->user()?->isEmployer())
                                <a href="{{ route('recruiter.dashboard') }}"
                                    class="block px-4 py-2 font-label-sm text-label-sm text-on-surface hover:bg-surface-container-high transition-colors">
                                    Dashboard
                                </a>
                            @endif

                            <!-- Divider Line -->
                            <hr class="border-surface-container-highest my-1">

                            <!-- Logout Link / Form Execution -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                @method("DELETE")
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 font-label-sm text-label-sm text-error hover:bg-error-container/20 transition-colors focus:outline-none">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Hamburger Button (visible on screens < 1200px) -->
            <button @click="mobileMenuOpen = true"
                    type="button"
                    class="min-[750px]:hidden text-primary p-2 rounded-lg hover:bg-surface-container-high transition-colors focus:outline-none flex items-center justify-center"
                    aria-label="Open menu">
                <span class="material-symbols-outlined text-2xl select-none">menu</span>
            </button>
        </div>
    </nav>

    {{-- Mobile Sidebar Drawer / Off-canvas --}}
    <div x-cloak
         x-show="mobileMenuOpen"
         class="relative z-50 min-[1200px]:hidden"
         role="dialog"
         aria-modal="true">
        
        <!-- Backdrop Overlay -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false"
             class="fixed inset-0 bg-black/70 backdrop-blur-sm"></div>

        <!-- Off-canvas Drawer Panel -->
        <div class="fixed inset-y-0 right-0 z-50 flex w-full max-w-xs sm:max-w-sm flex-col bg-surface-container border-l border-surface-container-highest shadow-2xl overflow-y-auto"
             x-show="mobileMenuOpen"
             x-transition:enter="transform transition ease-in-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transform transition ease-in-out duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             @keydown.window.escape="mobileMenuOpen = false">
             
            <!-- Drawer Header -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-surface-container-highest">
                <a href="/" @click="mobileMenuOpen = false" class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="w-24" alt="TechNexus">
                </a>
                <button type="button"
                        @click="mobileMenuOpen = false"
                        class="p-2 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors focus:outline-none"
                        aria-label="Close menu">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
            </div>

            <!-- Drawer Navigation Items -->
            <div class="flex-1 px-4 py-6 space-y-6 flex flex-col justify-between">
                <div class="space-y-1.5">
                    <div class="px-3 pb-2 text-xs font-semibold text-on-surface-variant uppercase tracking-wider">
                        Navigation
                    </div>

                    <a href="/"
                       class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs(['home', 'jobs.*']) ? 'bg-primary/10 text-primary font-semibold border-l-4 border-primary pl-3' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high' }}">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs(['home', 'jobs.*']) ? 'text-primary' : 'text-on-surface-variant' }}">work</span>
                        Find Jobs
                    </a>

                    <a href="{{ route('employers.index') }}"
                       class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('employers.*') ? 'bg-primary/10 text-primary font-semibold border-l-4 border-primary pl-3' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high' }}">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('employers.*') ? 'text-primary' : 'text-on-surface-variant' }}">domain</span>
                        Companies
                    </a>

                    <a href="/about"
                       class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('about') ? 'bg-primary/10 text-primary font-semibold border-l-4 border-primary pl-3' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high' }}">
                        <span class="material-symbols-outlined text-xl {{ request()->is('about') ? 'text-primary' : 'text-on-surface-variant' }}">info</span>
                        About
                    </a>

                    <a href="/saved-jobs"
                       class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('saved-jobs') ? 'bg-primary/10 text-primary font-semibold border-l-4 border-primary pl-3' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high' }}">
                        <span class="material-symbols-outlined text-xl {{ request()->is('saved-jobs') ? 'text-primary' : 'text-on-surface-variant' }}">bookmark</span>
                        Saved Jobs
                    </a>
                </div>

                <!-- Action / Account Section -->
                <div class="space-y-4 pt-4 border-t border-surface-container-highest">
                    <div>
                        <a href="{{ route('jobs.create') }}"
                           class="w-full flex items-center justify-center gap-2 py-3 px-4 btn-primary rounded-lg font-label-sm text-label-sm shadow-md hover:shadow-primary/20 transition-all">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            Post a Job
                        </a>
                    </div>

                    @guest
                        <div class="pt-2">
                            <a href="{{ route('login') }}"
                               class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg border border-surface-container-highest text-primary hover:bg-surface-container-high transition-colors font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-lg">login</span>
                                Sign In
                            </a>
                        </div>
                    @endguest

                    @auth
                        <div class="space-y-2 pt-2">
                            <div class="px-3 py-2.5 bg-surface-container-low rounded-lg border border-surface-container-highest flex items-center gap-3">
                                <span class="material-symbols-outlined text-3xl text-primary select-none">account_circle</span>
                                <div class="truncate min-w-0">
                                    <div class="text-sm font-semibold text-on-surface truncate">
                                        {{ auth()->user()->getFullName() ?: (auth()->user()->name ?? 'User') }}
                                    </div>
                                    <div class="text-xs text-on-surface-variant truncate">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('users.edit') }}"
                               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-on-surface hover:bg-surface-container-high transition-colors font-label-sm">
                                <span class="material-symbols-outlined text-lg text-on-surface-variant">person</span>
                                My Profile
                            </a>

                            @if (auth()?->user()?->isEmployer())
                                <a href="{{ route('recruiter.dashboard') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-on-surface hover:bg-surface-container-high transition-colors font-label-sm">
                                    <span class="material-symbols-outlined text-lg text-on-surface-variant">dashboard</span>
                                    Dashboard
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                @method("DELETE")
                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-error hover:bg-error-container/20 transition-colors font-label-sm">
                                    <span class="material-symbols-outlined text-lg">logout</span>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <main
        class="flex-1 w-full mx-auto max-w-container-max px-margin-mobile md:px-margin-desktop py-[50px] md:py-[50px]">
        @if (session('success'))
            <x-flash-message type="success" message="{{ session('success') }}" />
        @endif

        @if (session('error'))
            <x-flash-message type="error" message="{{ session('error') }}" />
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer
        class="bg-surface-container-lowest text-primary font-label-sm text-label-sm w-full border-t border-surface-container-highest mt-auto">
        <div
            class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop py-8 max-w-container-max mx-auto gap-4 md:gap-0">
            <div class="font-headline-md text-headline-md text-on-surface">Pixel Positions</div>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="/about" class="text-on-surface-variant hover:text-primary transition-colors">About Us</a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors">Contact</a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors">Privacy
                    Policy</a>
                <a href="#" class="text-on-surface-variant hover:text-primary transition-colors">Terms of
                    Service</a>
            </div>
            <div class="text-on-surface-variant">© {{ date('Y') }} TechNexus. Engineering the future of work.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    @stack('scripts')
</body>

</html>
