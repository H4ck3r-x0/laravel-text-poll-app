<div class="mt-8">
    @foreach ($pools as $pool)
        <div class="mx-auto max-w-4xl mb-6" wire:key="{{ $pool->id }}">
            <div
                class="flex flex-col gap-6 bg-gray-700 text-gray-300 dark:bg-gray-800 dark:text-gray-200 p-8 rounded-lg shadow-lg">
                <header class="flex items-center gap-6 w-full pl-0">
                    <img class="w-20 h-20 shadow-lg rounded-lg" src="https://i.pravatar.cc/150?img={{ auth()->id() }}"
                        alt="avatar">
                    <div class="flex-1">
                        <h1 class="text-3xl text-white">{{ $pool->user->name ?? 'Mohammed Fahad' }}</h1>
                        <ul class="flex items-center gap-2  stroke-purple-500">
                            <li class="text-xs  font-semibold text-gray-400">38 Pools</li>
                            <li class="text-xs font-semibold text-gray-400">|</li>
                            <li class="text-xs font-semibold text-gray-400">
                                Member Since
                                {{ $pool->user->created_at->diffForHumans() }}
                            </li>
                        </ul>
                    </div>
                    <p class="text-sm text-gray-400">{{ $pool->created_at->diffForHumans() }}</p>
                </header>

                <section class="flex flex-col gap-6">
                    <p class="text-lg text-white tracking-wide">{{ $pool->question }}</p>
                    @foreach ($pool->options as $option)
                        <label>
                            <div class="relative pt-1">
                                <div
                                    class="overflow-hidden h-12 mb-2  flex rounded bg-green-100 hover:bg-green-500 hover:cursor-pointer transition-all">
                                    <div style="width:{{ $option->percentage }}%"
                                        class="shadow-none flex flex-col  justify-center bg-green-400">
                                        <div class="px-4">
                                            <p class="text-lg text-gray-800">{{ $option->text }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input wire:model="selectedOption" type="radio" name="option_id"
                                        value="{{ $option->id }}" class="hidden">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-100">(
                                            {{ $option->votes_count }} {{ Str::plural('vote', $option->votes) }}
                                            ,
                                            {{ $option->percentage }}% )</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    @endforeach

                    <div class="flex justify-end">
                        <button type="button" wire:click="vote({{ $pool->id }})" @disabled($pool->hasVoted ? true : false)
                            class="bg-gray-600 dark:bg-gray-700 text-white px-10 py-4 hover:text-green-300 hover:bg-opacity-75 rounded-xl disabled:hover:text-white disabled:bg-gray-500 disabled:cursor-not-allowed">
                            <x-send-icon />
                        </button>
                    </div>

                </section>
            </div>
        </div>
    @endforeach
</div>
