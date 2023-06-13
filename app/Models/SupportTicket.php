<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'detail'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }
}
