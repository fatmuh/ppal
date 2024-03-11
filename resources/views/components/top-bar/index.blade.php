<!-- BEGIN: Top Bar -->
<div class="relative z-[51] flex h-[67px] items-center border-b border-slate-200">
    <!-- BEGIN: Breadcrumb -->
    <x-base.breadcrumb class="hidden mr-auto -intro-x sm:flex">
        @yield('breadcrumb')
    </x-base.breadcrumb>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
    <x-base.menu>
        <x-base.menu.button class="image-fit zoom-in intro-x block h-8 w-8 overflow-hidden rounded-full shadow-lg">
            <img
                src="{{ (auth()->user()->photo) ? auth()->user()->photo : 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
                alt="{{ auth()->user()->name }}"
            />
        </x-base.menu.button>
        <x-base.menu.items class="mt-px w-56 bg-primary text-white">
            <x-base.menu.header class="font-normal">
                <div class="font-medium">{{ auth()->user()->name ?? 'User'}}</div>
                <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">
                    Admin
                </div>
            </x-base.menu.header>
            <x-base.menu.divider class="bg-white/[0.08]" />
            <x-base.menu.item class="hover:bg-white/5">
                <x-base.lucide
                    class="mr-2 h-4 w-4"
                    icon="User"
                /> Profil
            </x-base.menu.item>
            <x-base.menu.item class="hover:bg-white/5">
                <x-base.lucide
                    class="mr-2 h-4 w-4"
                    icon="Lock"
                /> Ganti Password
            </x-base.menu.item>
            <x-base.menu.divider class="bg-white/[0.08]" />
            <x-base.menu.item class="hover:bg-white/5" href="{{ route('auth.logout') }}">
                <x-base.lucide
                    class="mr-2 h-4 w-4"
                    icon="ToggleRight"
                /> Logout
            </x-base.menu.item>
        </x-base.menu.items>
    </x-base.menu>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->

@once
    @push('scripts')
        @vite('resources/js/components/top-bar/index.js')
    @endpush
@endonce
