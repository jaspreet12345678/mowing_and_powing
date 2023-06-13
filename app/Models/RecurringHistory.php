<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class RecurringHistory extends Model
{
    use HasFactory;

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d',$value)->format('m/d/Y'),
        );
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function property(){
        return $this->belongsTo(Property::class,'property_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function scopeOrder(){
        return Order::first();
    }

    public function lawnSize(){
        return $this->belongsTo(LawnSize::class,'lawn_size_id');
    }

    public function cornerLot(){
        return $this->belongsTo(CornerLot::class,'corner_lot_id');
    }

    public function fence(){
        return $this->belongsTo(Fence::class,'fence_id');
    }

}
