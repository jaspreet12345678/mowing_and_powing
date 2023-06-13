<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'on_the_way',
        'on_the_way_date',
        'at_location_and_started_job',
        'at_location_and_started_job_date',
        'finished_job','finished_job_date',
        'checked_questions',
        'status'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d',$value)->format('m/d/Y'),
        );
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function lawnSize(){
        return $this->belongsTo(LawnSize::class,'lawn_size_id');
    }

    public function lawnHeight(){
        return $this->belongsTo(LawnHeight::class,'lawn_height_id');
    }

    public function cornerLot(){
        return $this->belongsTo(CornerLot::class,'corner_lot_id');
    }

    public function cleanUp(){
        return $this->belongsTo(Cleanup::class,'cleanup_id');
    }

    public function fence(){
        return $this->belongsTo(Fence::class,'fence_id');
    }

    public function schedule(){
        return $this->belongsTo(SnowPlowingSchedule::class,'snow_plowing_schedule_id');
    }

    public function color(){
        return $this->belongsTo(Color::class,'color_id');
    }

    public function car(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function snowDepth(){
        return $this->belongsTo(SnowDepth::class,'snow_depth_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function property(){
        return $this->belongsTo(Property::class,'property_id');
    }

    public function provider(){
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function period(){
        return $this->belongsTo(ServicePeriod::class,'service_period_id');
    }

    public function images(){
        return $this->hasMany(OrderImage::class);
    }

    public function providerimages(){
        return $this->hasMany(OrderImageByProvider::class);
    }

    public function proposals(){
        return $this->hasMany(Proposal::class);
    }

    public function rating(){
        return $this->hasOne(Rating::class);
    }

    public function beforeImages(){
        return $this->hasMany(OrderImageByProvider::class,'order_id')->whereType('before');
    }

    public function afterImages(){
        return $this->hasMany(OrderImageByProvider::class,'order_id')->whereType('after');
    }

    public function scopeWithinRadius($query)
    {
        $query->select('*',DB::raw("(6371 * acos(cos(radians(lat)) * cos(radians(".auth()->user()->lat.")) * cos(radians(".auth()->user()->lng.") - radians(lng)) + sin(radians(lat)) * sin(radians(".auth()->user()->lat.")))) * 0.621371 AS distance"))
            ->having('distance', '<=',settings('radius'));
    }

    public function scopeProviderChecks($query)
    {
        $query->whereAssignedTo(auth()->user()->id)->wherePaymentStatus(2);
    }

    public function scopeWithOptions($query)
    {
        $query->with('images','property','period');
    }

}
