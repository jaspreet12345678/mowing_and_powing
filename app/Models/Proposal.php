<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','provider_id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public function provider(){
        return $this->belongsTo(User::class)->select(['id', 'first_name','last_name','address','lat','lng','image']);
    }

    public function user(){
        return $this->belongsTo(User::class,'provider_id');
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
