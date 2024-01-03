<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolLike extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['user:id,avatar'];

    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
