<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['xp_required', 'reward_gold'];

    public function xpGoldReward()
    {
        return $this->morphOne(XpGoldReward::class, 'rewardable');
    }

    public function rewards()
    {
        return $this->morphMany(Reward::class, 'rewardable');
    }
}
