<div class="mt-8">
    @foreach ($pools as $pool)
        <div class="mx-auto max-w-4xl mb-6">
            <div
                class="flex flex-col gap-6 bg-gray-700 text-gray-300 dark:bg-gray-800 dark:text-gray-200 p-8 rounded-lg shadow-lg">
                <header class="flex items-center gap-6 w-full pl-0">
                    <img class="w-20 h-20 shadow-lg rounded-lg" src="https://i.pravatar.cc/150?img=3" alt="avatar">
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
                        <div class="relative pt-1">
                            <div class="overflow-hidden h-9 mb-4 text-xs flex rounded bg-pink-200">
                                <div style="width:{{ $option->percentage }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500">
                                </div>
                            </div>
                            <div>
                                <label>
                                    <input type="radio" name="option_id" value="{{ $option->id }}">
                                    {{ $option->text }} ({{ $option->votes_count }} votes, {{ $option->percentage }}%)
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit">Vote</button>

                </section>
            </div>
        </div>
    @endforeach
</div>
