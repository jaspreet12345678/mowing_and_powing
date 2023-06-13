<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class ProviderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'company_name',
        'company_size',
        'industry_type',
        'company_website',
        'company_address',
        'lat',
        'lng',
        'zip_code',
        'license_image',
        'last_known_lat',
        'last_known_lng',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }
}
