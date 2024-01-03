<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    #[Validate('required|image|max:1024')]
    public $avatar;

    /**
     * Save the updated avatar.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $avatarPath = $this->avatar->store('avatars', 'public');

        $user = Auth::user();

        $user->avatar = $avatarPath;
        $user->save();

        $this->avatar = null;

        $this->dispatch('avatar-uploaded');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Your Avatar') }}
        </h2>
    </header>

    <form wire:submit.prevent()="save" class="mt-4">
        <div class="flex flex-row items-center gap-4">
            @if ($avatar)
                <img class=" w-28 h-28 rounded-full" src="{{ $avatar->temporaryUrl() }}">
            @elseif (Auth::user()->avatar)
                <img class=" w-28 h-28 rounded-full" src="{{ Auth::user()->avatar }}">
            @endif


            <div class="flex flex-col gap-3">
                <input wire:model="avatar"
                    class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer  border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-600  focus:text-neutral-700 focus:shadow-te-primary focus:outline-none  dark:file:bg-gray-700 dark:file:text-gray-100 "
                    type="file" />
                <div class="flex items-center gap-3">

                    <button type="submit" @disabled(!$avatar)
                        class="w-fit inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 disabled:cursor-not-allowed disabled:bg-gray-600 disabled:hover:bg-gray-600">Upload</button>
                    <x-action-message class="me-3" on="avatar-uploaded">
                        {{ __('Avatar Uploaded.') }}
                    </x-action-message>

                </div>
            </div>
        </div>

        <div class="mt-4">
            @error('avatar')
                <span class="text-red-400 font-semibold">{{ $message }}</span>
            @enderror
        </div>

    </form>
</section>
