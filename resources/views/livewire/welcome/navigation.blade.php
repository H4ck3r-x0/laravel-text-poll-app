<div class=" flex items-center justify-between w-full">
    <div class="flex items-center gap-4">
        <a href="/" wire:navigate>
            <x-application-logo class="w-12 h-12 fill-current text-gray-500" />
        </a>
        <h2 class="text-lg text-gray-800 dark:text-gray-300 font-semibold">Laravel Pool</h2>
    </div>
    <div>
        @auth
            <div class="flex items-center gap-3">
                <a href="{{ url('/dashboard') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    wire:navigate>Dashboard</a>

                <x-dropdown>
                    <x-slot:trigger>
                        <x-button icon="o-light-bulb" class="" />
                    </x-slot:trigger>

                    <x-menu-item title="Dark" />
                    <x-menu-item title="Light" />
                </x-dropdown>
            </div>
        @else
            <a href="{{ route('login') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                wire:navigate>Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    wire:navigate>Register</a>
            @endif
        @endauth
    </div>
</div>
