<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'card_id',
        'brand',
        'country',
        'fingerprint',
        'funding',
        'card_number',
        'last4',
        'cvv',
        'exp_month',
        'exp_year',
        'is_default',
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }
}
