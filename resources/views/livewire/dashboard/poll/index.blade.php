<div class="mt-8" x-data="{ load: false }">
    @foreach ($pools as $pool)
        <div class="mx-auto max-w-5xl  mb-6" wire:key="{{ $pool->id }}">
            <div
                class="flex flex-col gap-6 bg-gray-700 text-gray-300 dark:bg-gray-800 dark:text-gray-200 p-8 rounded-lg shadow-lg">
                <header class="flex items-center gap-6 w-full pl-0">
                    <img class="w-20 h-20 shadow-lg rounded-lg" src="https://i.pravatar.cc/150?u={{ $pool->user->id }}"
                        alt="avatar">
                    <div class="flex-1">
                        <h1 class="text-lg sm:text-3xl truncate text-white">
                            {{ $pool->user->name }}
                        </h1>
                        <ul class="flex items-center gap-2  stroke-purple-500">
                            <li class="text-xs  font-semibold text-gray-400">
                                {{ $pool->user_pools_count }} {{ Str::plural('Poll', $pool->user_pools_count) }}
                            </li>
                            <li class="text-xs font-semibold text-gray-400">|</li>
                            <li class="text-xs font-semibold text-gray-400">
                                Member Since
                                {{ $pool->user->created_at->diffForHumans() }}
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center gap-4">
                        <p class="text-sm text-gray-400">{{ $pool->created_at->diffForHumans() }}</p>
                        {{-- Dropdown here,, --}}
                    </div>
                </header>

                <section class="flex flex-col gap-6">
                    <p class="text-lg text-white tracking-wide">{{ $pool->question }}</p>
                    @foreach ($pool->options as $option)
                        <label>
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-12 mb-2  flex rounded-full bg-green-50  transition-all">
                                    <div style="width:{{ $option->percentage }}%"
                                        class="shadow-none flex flex-col  justify-center bg-green-400">
                                        <div class="px-4">
                                            <p class="text-lg text-gray-800">
                                                {{ $option->text }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="radio" name="option_id" value="{{ $option->id }}" class="hidden">
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
                </section>

                <footer>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">

                            <button type="button" @disabled(true)
                                class="flex items-center gap-2 bg-gray-600 dark:bg-gray-700 text-white px-4 py-2   rounded-xl  {{ $pool->hasLiked ? 'bg-red-300 hover:text-white text-white dark:bg-red-400' : '' }}">
                                <x-like-icon />
                                {{ $pool->likes_count }}
                            </button>
                            <div>
                                <div class="sm:flex items-center hidden  avatar-group -space-x-6">
                                    @foreach ($pool->likes->take(5) as $like)
                                        <div class="avatar">
                                            <div class="w-10">
                                                <img src="https://i.pravatar.cc/150?img={{ rand(1, 5) }}" />
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($pool->likes_count - $pool->likes->take(5)->count() !== 0)
                                        <div class="avatar placeholder">
                                            <div class="w-10 bg-neutral text-neutral-content">
                                                <span>+{{ $pool->likes_count - $pool->likes->take(5)->count() }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </footer>
            </div>
        </div>
    @endforeach

</div>
