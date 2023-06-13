<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_refill',
        'auto_refill_amount',
        'user_id',
        'auto_refill_card_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }
}
