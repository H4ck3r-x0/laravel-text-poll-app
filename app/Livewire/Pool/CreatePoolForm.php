<?php

namespace App\Livewire\Pool;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class CreatePoolForm extends Component
{

    use Toast;

    /**
     * The question for the CreatePoolForm.
     *
     * @var string
     */
    #[Validate('required')]
    public string $question = '';

    /**
     * The options for the CreatePoolForm.
     *
     * @var array
     */
    #[Validate([
        'options' => 'required|array|min:2|max:10',
        'options.*' => 'required|min:2|max:65',
    ], message: [
        'required' => 'The :attribute cannot be empty.',
        'options.required' => 'The :attribute are missing.',
    ], attribute: [
        'options.*' => 'option',
    ])]
    public array $options = [''];

    public $userPoolsCount;


    public function mount()
    {
        $this->userPoolsCount = auth()->user()->pools()->count();
    }

    /**
     * Adds an empty option to the options array.
     */
    public function addOption()
    {
        $this->options[] = '';
    }

    /**
     * Remove an option from the options array.
     *
     * @param int $index The index of the option to remove.
     * @return void
     */
    public function removeOption($index)
    {
        unset($this->options[$index]);
    }


    public function resetOptions()
    {
        $this->options = [''];
    }

    public function createPool()
    {
        $this->validate();

        $pool = auth()->user()->pools()->create([
            'question' => $this->question,
        ]);

        $pool->options()->createMany(
            collect($this->options)->map(fn ($option) => ['text' => $option])->all()
        );

        $this->reset('question');
        $this->resetOptions();
        $this->dispatch('poolCreated');

        $this->toast(
            type: 'success',
            title: 'It is done!',
            description: null,                  // optional (text)
            position: 'toast-top toast-end',    // optional (daisyUI classes)
            icon: 'o-information-circle',       // Optional (any icon)
            css: 'alert-info',                  // Optional (daisyUI classes)
            timeout: 3000,                      // optional (ms)
        );
    }

    public function render()
    {
        return view('livewire.pool.create-pool-form');
    }
}
