<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['goal_id', 'title', 'description', 'is_completed'];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function xpGoldReward()
    {
        return $this->morphOne(XpGoldReward::class, 'rewardable');
    }

    public function rewards()
    {
        return $this->morphMany(Reward::class, 'rewardable');
    }
}
