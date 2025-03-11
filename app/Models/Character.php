<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'name',
        'xp',
        'gold',
        'level_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function purchasesHistory()
    {
      return $this->hasMany(PurchasesHistory::class);
    }
}