<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'xp_reward',
        'gold_reward',
    ];

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function rewardsHistory()
    {
        return $this->hasMany(RewardsHistory::class);
    }
}