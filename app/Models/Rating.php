<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'provider_id',
        'user_id',
        'comment',
        'response_time_rating',
        'quality_rating',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public function user(){
        return $this->belongsTo(User::class)->select(['id', 'first_name','last_name','image']);
    }

    public function order(){
        return $this->belongsTo(Order::class)->select(['category_id']);
    }
}
