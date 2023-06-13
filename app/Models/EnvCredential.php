<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvCredential extends Model
{
    use HasFactory;
    protected $table='env_credentials';
    protected $fillable= ['key','value'];
    
}
