<?php

namespace App\Livewire\Pool;

use App\Models\Pool;
use App\Models\PoolLike;
use App\Models\Vote;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Pools extends Component
{
    use Toast;
    /**
     * @var array $pools The pools data.
     */
    public $pools;

    /**
     * The amount of pools.
     *
     * @var int
     */
    public $amount = 5;

    /**
     * The selected option for the pool.
     *
     * @var mixed
     */

    public array $selectedOption = [];


    /**
     * Selects an option for a specific pool.
     *
     * @param int $poolId The ID of the pool.
     * @param int $optionId The ID of the option to select.
     * @return void
     */
    public function selectOption($poolId, $optionId)
    {
        $this->selectedOption[$poolId] = $optionId;
    }


    /**
     * Vote for a pool option.
     *
     * @param int $poolId The ID of the pool.
     * @return void
     */
    public function vote($poolId)
    {
        if (!isset($this->selectedOption[$poolId])) {
            return;
        }

        $optionId = $this->selectedOption[$poolId];

        Vote::firstOrCreate(
            ['user_id' => auth()->id(), 'pool_id' => $poolId],
            ['option_id' => $optionId]
        );

        $this->toast(
            type: 'success',
            title: 'Thanks for your voting!',
            position: 'toast-top ',
            icon: 'o-check-badge',
            css: 'alert-info text-white',
            timeout: 5000,
        );
    }

    /**
     * Toggle the like status of a pool.
     *
     * @param int $poolId The ID of the pool to like/unlike.
     * @return void
     */
    public function like($poolId)
    {
        $poolLike = PoolLike::where('user_id', auth()->id())
            ->where('pool_id', $poolId);

        if ($poolLike->exists()) {
            $poolLike->delete();
        } else {
            PoolLike::create([
                'user_id' => auth()->id(),
                'pool_id' => $poolId
            ]);
        }
    }

    /**
     * Increase the amount by 5.
     *
     * @return void
     */
    public function load()
    {
        $this->amount += 5;
    }

    /**
     * Render the pools component.
     *
     * @return \Illuminate\View\View
     */
    #[On('poolCreated')]
    public function render()
    {
        $this->pools = Pool::with(
            [
                'user:id,name,avatar,created_at',
                'options',
                'options.votes',
                'likes',
                'votes'
            ]
        )
            ->withCount(['votes', 'likes'])
            ->latest()
            ->take($this->amount)
            ->get()
            ->each(function ($pool) {
                $pool->options = $pool->getOptionsWithPercentage();
                $pool->user_pools_count = $pool->user->pools()->count();
            });


        return view('livewire.pool.pools', ['pools' => $this->pools]);
    }

    /**
     * Opens the comments modal for a specific pool.
     *
     * @param int $poolId The ID of the pool.
     * @return void
     */
    public function openCommentsModal($poolId)
    {
        $this->dispatch('openCommentsModal', poolId: $poolId);
    }
}
