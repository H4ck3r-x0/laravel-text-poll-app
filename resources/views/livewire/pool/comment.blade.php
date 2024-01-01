<div>
    <x-mary-modal wire:model="commentsModal">
        <div class="flex flex-col max-h-[650px] overflow-y-auto no-scrollbar">
            @if ($comments)
                @foreach ($comments as $comment)
                    <div class="bg-gray-500/10  p-4 my-2 rounded-md shadow-md">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-14 h-14 shadow-lg rounded-lg"
                                        src="https://i.pravatar.cc/150?u={{ $comment->user->id }}"
                                        alt="{{ $comment->user->name }}">
                                </div>
                                <div class="ml-3">
                                    <p class="text-lg font-medium text-gray-800 dark:text-white">
                                        {{ $comment->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-900 dark:text-white">
                            <p>
                                {{ $comment->body }}
                            </p>

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="flex items-center justify-between mt-4">
            <div class="w-full mr-3">
                <input wire:model="commentInput" type="text" placeholder="Write a comment .."
                    class="input input-bordered w-full text-gray-600 dark:text-gray-400" required />
                @error('commentInput')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <button type="button" wire:click="addComment" class="btn">
                <x-send-icon />
            </button>
        </div>
    </x-mary-modal>
</div>
