<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class TermAndCondition extends Model
{
    use HasFactory;
    protected $table = 'term_and_condition';
    protected $fillable = ['type','description', 'is_deleted'];
    protected $appends = ['clean_description'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public function getCleanDescriptionAttribute()
    {
        return strip_tags(html_entity_decode($this->description));
    }
}
