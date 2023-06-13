<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class FavoriteProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public function user(){
        return $this->belongsTo(User::class,'provider_id')->select(['id', 'first_name','last_name','address','lat','lng','image']);
    }
}
