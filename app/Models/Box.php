<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'name',
        'balance',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}