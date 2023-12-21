<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pool extends Model
{
    use HasFactory;

    public $guarded = [];

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
     * Get the options associated with the pool.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class)->withCount('votes');
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
}