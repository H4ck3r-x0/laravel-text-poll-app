<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public $guarded = [];

    /**
     * Get the pool that owns the vote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
