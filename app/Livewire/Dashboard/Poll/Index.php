<?php

namespace App\Livewire\Dashboard\Poll;

use App\Models\Pool;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $pools;

    public function mount()
    {
        $this->pools = Pool::query()
            ->with(
                'user:id,name,created_at',
                'options',
                'options.votes',
                'likes',
                'votes'
            )
            ->withCount(['votes', 'likes'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get()
            ->each(function ($pool) {
                $pool->options = $pool->getOptionsWithPercentage();
                $pool->user_pools_count = $pool->user->pools()->count();
            });
    }

    public function render()
    {
        return view('livewire.dashboard.poll.index');
    }
}
