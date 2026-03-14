@php
    use App\Support\Sidebar;
    $sidebar = config('ui.sidebar', []);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:sidebar sticky collapsible="mobile"
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

        {{-- Header --}}
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        {{-- Dynamic Sidebar --}}
        <flux:sidebar.nav>

            @foreach ($sidebar as $section)

                {{-- GROUP --}}
                @if ($section['type'] === 'group')
                    <flux:sidebar.group :heading="__($section['text'])" class="grid">

                        @foreach ($section['items'] as $item)
                            @if (Sidebar::shouldRender($item))
                                <flux:sidebar.item
                                    :href="Sidebar::href($item)"
                                    :current="request()->routeIs(Sidebar::currentPattern($item))"
                                    wire:navigate
                                >
                                    @if (Sidebar::isFluxIcon($item))
                                        <flux:icon :name="$item['icon']" class="w-5 h-5" />
                                    @else
                                        <i class="{{ $item['icon'] }} w-4 h-4"></i>
                                    @endif

                                    {{ __($item['text']) }}
                                </flux:sidebar.item>
                            @endif
                        @endforeach

                    </flux:sidebar.group>

                {{-- SINGLE LINK --}}
                @elseif ($section['type'] === 'link')

                    @if (Sidebar::shouldRender($section))
                        <flux:sidebar.item
                            :href="Sidebar::href($section)"
                            target="{{ $section['target'] ?? '_self' }}"
                        >
                            @if (Sidebar::isFluxIcon($section))
                                <flux:icon :name="$section['icon']" class="w-5 h-5" />
                            @else
                                <i class="{{ $section['icon'] }} w-4 h-4"></i>
                            @endif

                            {{ __($section['text']) }}
                        </flux:sidebar.item>
                    @endif

                @endif

            @endforeach

        </flux:sidebar.nav>

        <flux:spacer />

        {{-- Theme Toggle --}}
        @if (config('ui.toggle_theme', true))
            <flux:sidebar.nav>
                <flux:sidebar.item
                    x-data
                    x-on:click="$flux.dark = ! $flux.dark"
                    class="cursor-pointer"
                >
                    <template x-if="$flux.dark">
                        <span class="flex items-center gap-2">
                            <flux:icon.sun class="text-yellow-500" />
                            {{ __('Light Mode') }}
                        </span>
                    </template>

                    <template x-if="!$flux.dark">
                        <span class="flex items-center gap-2">
                            <flux:icon.moon class="text-blue-500" />
                            {{ __('Dark Mode') }}
                        </span>
                    </template>
                </flux:sidebar.item>
            </flux:sidebar.nav>
        @endif

        {{-- Desktop User Menu  --}}
        <x-desktop-user-menu
            class="hidden lg:block"
            :name="auth()->user()->name"
        />

    </flux:sidebar>

    {{-- Mobile Header --}}
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle icon="bars-2" inset="left" />
        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                    {{ __('Settings') }}
                </flux:menu.item>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full"
                    >
                        {{ __('Log out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>
</html>