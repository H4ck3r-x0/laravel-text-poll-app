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

    public function save()
    {
        $this->validate();
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
            <img class=" w-28 h-28 " src="https://avatar.iran.liara.run/public/{{ auth()->id() }}" alt="">
            <div class="flex flex-col gap-3">
                <input wire:model="avatar"
                    class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                    id="" type="file" />
                <x-primary-button class="w-fit">{{ __('Upload') }}</x-primary-button>
            </div>
        </div>

        <div class="mt-4">
            @error('avatar')
                <span class="text-red-400 font-semibold">{{ $message }}</span>
            @enderror
        </div>

    </form>
</section>
