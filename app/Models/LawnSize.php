<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class LawnSize extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','price','seven_days_price','ten_days_price','fourteen_days_price','is_deleted'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }
    
    public function cleanUps()
    {
        return $this->hasMany(Cleanup::class,'lawn_size_id');
    }
}
