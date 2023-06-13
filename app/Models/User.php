<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DateTimeInterface;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'new_email',
        'unverified_email',
        'referral_link',
        'referred_by',
        'password',
        'phone_number',
        'type',
        'country',
        'zip_code',
        'last_login_device',
        'otp',
        'state',
        'city',
        'address',
        'lat',
        'lng',
        'image',
        'customer_id',
        'google_id',
        'status',
        'phone_number_verified_at',
        'email_verified_at',
        'default_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['averageQualityRatings'];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? '/assets/images/default.png',
        );
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m-d-Y H:i:s');
    }

    public static function boot()
    {
        parent::boot();

        self::updating(function($model){
            if(gettype($model->image) == 'object'){
                $foldername = '/uploads/clients/profile pics/';
                $filename = time().'-'.rand(0000000,9999999).'.'.$model->image->extension();
                $model->image->move(public_path().$foldername,$filename);
                $model->image = $foldername.$filename;
            }
        });
    }

    public function getAverageQualityRatingsAttribute()
    {
        $totalRating = 0;

        if ($this->ratings->count()) {
            $sumOfRatings = $this->ratings->sum('quality_rating');
            $totalRating = $sumOfRatings / $this->ratings->count();
        }

        return $totalRating;
    }

    public function getTotalReviewsAttribute()
    {
        return $this->ratings->count();
    }

    // One to Many relationship with Support Tickets
    public function supportTickets(){
        return $this->hasMany(SupportTicket::class);
    }

    public function companyDetail(){
        return $this->hasOne(ProviderDetail::class,'provider_id');
    }

    public function portfolioImages(){
        return $this->hasMany(ProviderPortfolio::class,'provider_id');
    }

    public function insuranceInformationImages(){
        return $this->hasMany(InsuranceInformationImage::class,'provider_id');
    }

    public function providerLicenseImages(){
        return $this->hasMany(ProviderLicenseImage::class,'provider_id');
    }

    public function providerDetails(){
        return $this->hasOne(ProviderDetail::class,'provider_id');
    }

    public function providerLastLocation(){
        return $this->hasOne(ProviderDetail::class,'provider_id')->select(['id','provider_id', 'last_known_lat','last_known_lng']);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function  Property(){
        return $this->hasMany(Property::class);
    }

    public function favoriteProviders()
    {
        return $this->hasMany(FavoriteProvider::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class,'provider_id');
    }

    public function ticket()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function reffer()
    {
         return $this->hasOne(User::class,'id','referred_by');
    }

}
