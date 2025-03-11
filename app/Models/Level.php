<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'required_xp',
        'reward_id',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}