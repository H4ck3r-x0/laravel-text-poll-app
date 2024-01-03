<?php

namespace App\Livewire\Pool;

use App\Models\Comment as CommentModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Comment extends Component
{
    /**
     * The ID of the pool.
     *
     * @var int
     */
    public $poolId;

    /**
     * The comments for the pool.
     *
     * @var array
     */
    public $comments;

    /**
     * Indicates whether the comments modal is open or closed.
     *
     * @var bool
     */
    public bool $commentsModal = false;

    /**
     * Represents a comment in the pool.
     *
     * @var string $commentInput The input for the comment.
     */
    #[Validate('required|min:3')]
    public string $commentInput = '';

    /**
     * Opens the comments modal and retrieves the comments for a specific pool.
     *
     * @param int $poolId The ID of the pool.
     * @return void
     */
    #[On('openCommentsModal')]
    public function openCommentsModal($poolId)
    {
        $this->poolId = $poolId;
        $this->commentsModal = true;

        $this->comments = CommentModel::where('pool_id', $this->poolId)
            ->withUser()
            ->latest()
            ->get();
    }


    /**
     * Add a new comment to the pool.
     *
     * @return void
     */
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
