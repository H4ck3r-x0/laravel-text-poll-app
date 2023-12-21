<?php

namespace App\Livewire\Pool;

use Livewire\Component;

class CreatePoolForm extends Component
{
    /**
     * The options for the CreatePoolForm.
     *
     * @var array
     */
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

    public function render()
    {
        return view('livewire.pool.create-pool-form');
    }
}
