<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Faq extends Model
{
    use HasFactory;
    protected $table= 'faqs';
    protected $fillable= ['type','question', 'answer'];

    protected $appends = ['clean_answer'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public function getCleanAnswerAttribute()
    {
        return strip_tags(html_entity_decode($this->answer));
    }
}
