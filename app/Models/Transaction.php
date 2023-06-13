<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'order_id',
        'transaction_id',
        'amount',
        'status',
        'type',
        'account',
        'stripe_response',
        'provider_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

}
