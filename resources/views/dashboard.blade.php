<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Welcome back {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-3xl font-semibold text-gray-700">Your Polls</h1>
                @livewire('dashboard.poll.index')
            </div>
        </div>
    </div>
</x-app-layout>
