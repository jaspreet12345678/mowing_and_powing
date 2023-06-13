<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityList extends Model
{
    protected $table='us_cities';
    use HasFactory;


    public function state()
    {
        return $this->hasone(State::class,'ID','ID_STATE');
    }
    public function city()
    {
        return $this->hasone(City::class,'name','ID');
    }
}
