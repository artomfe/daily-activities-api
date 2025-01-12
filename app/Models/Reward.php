<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = ['rewardable_id', 'rewardable_type', 'item_id', 'quantity'];

    public function rewardable()
    {
        return $this->morphTo();
    }

    public function item()
    {
        return $this->belongsTo(StoreItem::class);
    }
}
