<?php

namespace App\Livewire\Pool;

use App\Models\Option;
use App\Models\Pool;
use App\Models\PoolLike;
use App\Models\Vote;
use Livewire\Attributes\On;
use Livewire\Component;

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


    public function selectOption($optionId)
    {
        $this->selectedOption = $optionId;
    }


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

    public function like($poolId)
    {

        $poolLike = PoolLike::where('user_id', auth()->id())->where('pool_id', $poolId);

        if ($poolLike->exists()) {
            $poolLike->delete();
        } else {
            PoolLike::create([
                'user_id' => auth()->id(),
                'pool_id' => $poolId
            ]);
        }
    }

    #[On('poolCreated')]
    public function render()
    {
        $this->pools = Pool::with(
            [
                'user:id,name,created_at',
                'options',
                'options.votes',
                'likes',
                'votes'
            ]
        )
            ->withCount(['votes', 'likes'])
            ->latest()
            ->get()
            ->each(function ($pool) {
                $pool->options = $pool->getOptionsWithPercentage();
                $pool->user_pools_count = $pool->user->pools()->count();
            });


        return view('livewire.pool.pools', ['pools' => $this->pools]);
    }
}
