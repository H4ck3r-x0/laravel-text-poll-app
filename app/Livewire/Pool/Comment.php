<?php

namespace App\Livewire\Pool;

use App\Models\Comment as CommentModel;
use App\Models\Pool;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Comment extends Component
{
    public $poolId;

    public $comments;

    public bool $commentsModal = false;

    #[Validate('required|min:3')]
    public string $commentInput = '';



    #[On('openCommentsModal')]
    public function openCommentsModal($poolId)
    {
        $this->poolId = $poolId;
        $this->commentsModal = true;

        $this->comments = CommentModel::withUser()
            ->where('pool_id', $this->poolId)
            ->latest()
            ->get();
    }


    public function addComment()
    {
        $this->validate();

        CommentModel::create([
            'pool_id' => $this->poolId,
            'user_id' => auth()->id(),
            'body' => $this->commentInput,
        ]);

        $this->commentInput = '';

        $this->comments = CommentModel::withUser()
            ->where('pool_id', $this->poolId)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.pool.comment');
    }
}
