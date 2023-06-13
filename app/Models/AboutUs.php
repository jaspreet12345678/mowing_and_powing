<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class AboutUs extends Model
{
    use HasFactory;
    protected $table= 'about_us';
    protected $fillable = ['description'];

    protected $appends = ['clean_about_us'];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public function getCleanAboutUsAttribute()
    {
        return strip_tags(html_entity_decode($this->description));
    }
}
