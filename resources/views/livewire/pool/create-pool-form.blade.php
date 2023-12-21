<div class="mx-auto max-w-4xl" id="autoAnimateContainer">
    <div
        class="flex flex-col gap-6 bg-gray-700 text-gray-300 dark:bg-gray-800 dark:text-gray-200 p-8 rounded-lg shadow-lg">
        <header class="flex items-center gap-6 w-full pl-0">
            <img class="w-20 h-20 shadow-lg rounded-lg" src="https://i.pravatar.cc/150?img=3" alt="avatar">
            <div>
                <h1 class="text-3xl text-white">{{ auth()->user()->name ?? 'Mohammed Fahad' }}</h1>
                <ul class="flex items-center gap-2  stroke-purple-500">
                    <li class="text-xs  font-semibold text-gray-400">38 Pools</li>
                    <li class="text-xs font-semibold text-gray-400">|</li>
                    <li class="text-xs font-semibold text-gray-400">
                        Member Since
                        {{ auth()->user()?->created_at->diffForHumans() ?? '22 days ago' }}
                    </li>
                </ul>
            </div>
        </header>

        <section class="flex flex-col gap-6">
            <textarea wire:model="question" autofocus
                class="w-full bg-gray-700 text-gray-200 border  resize-none rounded-xl px-4 py-3 placeholder:text-gray-400 placeholder:dark:text-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
                placeholder="What's in your mind?" rows="1"></textarea>
            @error('question')
                <span class="text-red-500 text-xs -mt-3">{{ $message }}</span>
            @enderror
            <div>
                @foreach ($options as $index => $option)
                    <div class="relative flex items-center gap-3 {{ $index > 0 ? 'mt-4' : '' }}">
                        <input type="text" placeholder="Add Option"
                            class="w-full bg-gray-700 text-gray-200 border resize-none rounded-xl px-4 py-3 placeholder:text-gray-400 placeholder:dark:text-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
                            wire:model="options.{{ $index }}">

                        <button class="absolute right-0 px-3 text-gray-400 hover:text-red-300"
                            wire:click.prevent="removeOption({{ $index }})">
                            <x-trash-icon />
                        </button>
                    </div>
                @endforeach
            </div>

            @error('options')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @error('options.*')
                <span class=" text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </section>

        <footer class="flex items-center justify-between mt-8">
            <div class="flex items-center gap-3">
                <button wire:click="addOption"
                    class="flex items-center gap-2 bg-gray-600 dark:bg-gray-700 text-white px-8 py-3 hover:text-green-300 hover:bg-opacity-75 rounded-xl transition-all">
                    <x-plus-icon />
                    <span class="tracking-wide">Add Option</span>
                </button>

                @if (count($options) > 3)
                    <button wire:click="resetOptions" wire:confirm="Are you sure you want to reset all options inputs?"
                        class="bg-gray-600 dark:bg-gray-700 flex items-center gap-2 text-white px-8 py-3 hover:text-red-300 hover:bg-opacity-75 rounded-xl transition-all">
                        <x-reset-icon />
                        <span class="tracking-wide">
                            Reset Options
                        </span>
                    </button>
                @endif
            </div>

            <button type="button" wire:click="createPool" @disabled(count($options) < 2 ? true : false)
                class="bg-gray-600 dark:bg-gray-700 text-white px-10 py-4 hover:text-green-300 hover:bg-opacity-75 rounded-xl disabled:hover:text-white disabled:bg-gray-500 disabled:cursor-not-allowed">
                <x-send-icon />
            </button>
        </footer>
    </div>
</div>
