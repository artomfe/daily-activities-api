<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XpGoldReward extends Model
{
    use HasFactory;

    protected $fillable = ['rewardable_id', 'rewardable_type', 'xp', 'gold'];

    public function rewardable()
    {
        return $this->morphTo();
    }
}
