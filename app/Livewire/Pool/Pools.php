<?php

namespace App\Livewire\Pool;

use App\Models\Pool;
use App\Models\Vote;
use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\On;

class Pools extends Component
{
    /**
     * @var array $pools The pools data.
     */
    public $pools;

    /**
     * The selected option for the pool.
     *
     * @var mixed
     */
    public $selectedOption;


    /**
     * Vote for a pool option.
     *
     * @param int $poolId The ID of the pool.
     * @return void
     */
    public function vote($poolId)
    {
        $optionId = $this->selectedOption;

        Vote::firstOrCreate(
            ['user_id' => auth()->id(), 'pool_id' => $poolId],
            ['option_id' => $optionId]
        );
    }

    #[On('poolCreated')]
    public function render()
    {
        $this->pools = Pool::with('user', 'options.votes')->latest()->get();

        foreach ($this->pools as $pool) {
            $pool->options = $pool->getOptionsWithPercentage();

            $pool->hasVoted = $pool->votes->contains('user_id', auth()->id());
        }

        return view('livewire.pool.pools', ['pools' => $this->pools]);
    }
}
