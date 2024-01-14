<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pool extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'has_voted',
    ];

    /**
     * Get the user that owns the pool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the votes for the pool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get the options associated with the pool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class)->withCount('votes');
    }

    /**
     * Get the likes associated with the pool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(PoolLike::class);
    }

    /**
     * Calculate the percentage of votes for each option in the pool.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOptionsWithPercentage()
    {
        $totalVotes = $this->options->sum('votes_count');

        foreach ($this->options as $option) {
            $option->percentage = $totalVotes > 0 ? round(($option->votes_count / $totalVotes) * 100, 2) : 0;
        }

        return $this->options;
    }

    /**
     * Get the value of the "hasVoted" attribute.
     *
     * @return bool
     */
    public function getHasVotedAttribute()
    {
        return $this->votes->contains('user_id', auth()->id());
    }

    /**
     * Get the user's vote for this pool.
     *
     * @return Vote|null
     */
    public function userVote()
    {
        return $this->votes()->where('user_id', auth()->id())->first();
    }

    /**
     * Get the value of the "hasLiked" attribute.
     *
     * @return bool
     */
    public function getHasLikedAttribute()
    {
        return $this->likes->contains('user_id', auth()->id());
    }
}
