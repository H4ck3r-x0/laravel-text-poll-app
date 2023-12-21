<?php

namespace App\Livewire\Pool;

use App\Models\Pool;
use Livewire\Attributes\On;
use Livewire\Component;

class Pools extends Component
{
    /**
     * @var array $pools The pools data.
     */
    public $pools;


    /**
     * Mount the component.
     *
     * Retrieve all pools with their associated user, options, and votes.
     * Calculate the percentage for each option in the pool.
     */
    #[On('poolCreated')]
    public function mount()
    {
        $this->pools = Pool::with('user', 'options.votes')->latest()->get();

        foreach ($this->pools as $pool) {
            $pool->options = $pool->getOptionsWithPercentage();
        }
    }


    public function render()
    {
        return view('livewire.pool.pools');
    }
}
