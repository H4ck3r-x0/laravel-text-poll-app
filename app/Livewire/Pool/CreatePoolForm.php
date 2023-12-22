<?php

namespace App\Livewire\Pool;

use App\Models\Pool;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePoolForm extends Component
{

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
    // #[Validate('required', 'min:2', 'max:10', 'array')]
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
            array_map(function ($option) {
                return ['text' => $option];
            }, $this->options)
        );

        $this->reset('question');
        $this->resetOptions();
        $this->dispatch('poolCreated');
    }

    public function render()
    {
        return view('livewire.pool.create-pool-form');
    }
}
