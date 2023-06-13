<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class FooterScript extends Model
{
    use HasFactory;
    protected $table= 'footer_script';
    protected $fillable= ['description'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }
}
