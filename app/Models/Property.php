<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'category_id',
        'user_id',
        'user_ip',
        'lat',
        'lng',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    // public function ordersCount(){
    //     return $this->hasMany(Order::class)->count();
    // }
}
