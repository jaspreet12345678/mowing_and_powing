<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Traits\HasRoles;
use DateTimeInterface;

class Admin extends Authenticatable
{
    use HasFactory,HasRoles;

    protected $fillable = ['name','email','password','phone_number','status','otp'];
    protected $guard_name = 'admin';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? '/assets/images/default.png',
        );
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->password = Hash::make($model->password);
        });
    }

}
