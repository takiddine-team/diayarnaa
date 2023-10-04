<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use App\Models\AdvertisementEditRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{



    


    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = "users";

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'office_phone',
        'diyarnaa_country_id',
        'diyarnaa_city_id',
        'diyarnaa_region_id',
        'street',
        'password',
        'user_type',
        'status',
        'license_image',
        'profile_image',
        'additional_information',
        'expire_date',
        'code',
        'is_verified',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================

    public function userMemberships()
    {
        return $this->hasMany(UserMembership::class);
    }

    public function diyarnaCountry()
    {
        return $this->belongsTo(DiyarnaaCountry::class, 'diyarnaa_country_id');
    }

    public function diyarnaCity()
    {
        return $this->belongsTo(DiyarnaaCity::class, 'diyarnaa_city_id');
    }

    public function diyarnaRegion()
    {
        return $this->belongsTo(DiyarnaaRegion::class, 'diyarnaa_region_id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'user_id', 'id');
    }


     public function customerRequestAndOffers()
    {
        return $this->hasMany(CustomerRequestAndOffer::class, 'user_id', 'id');
    }


    public function advertisementEditRequest()
    {
        return $this->hasMany(AdvertisementEditRequest::class, 'user_id', 'id');
    }

    public function enqueryRequests()
    {
        return $this->hasMany(EnqueryRequest::class, 'real_estate_office_id', 'id');
    }

    public function favouriteAdvertisements()
    {
        return $this->hasMany(FavouriteAdvertisement::class, 'user_id', 'id');
    }


    public function sentMails()
    {
        return $this->hasMany(Mail::class, 'sender_id', 'id')->where([
            ['sender_id', $this->id],
            ['sender_type', 2],
            ['deleter_type', 2],
        ])->orWhere([
            ['sender_id', $this->id],
            ['sender_type', 2],
            ['deleter_type', null],
        ])->orderBy('id', 'DESC');
    }

    public function receivedMails()
    {
        return $this->hasMany(Mail::class, 'receiver_id','id')->where([
            ['receiver_id', $this->id],
            ['receiver_type', 2],
            ['deleter_type', 1],
        ])->orWhere([
            ['receiver_id', $this->id],
            ['receiver_type', 2],
            ['deleter_type', null],
        ])->orderBy('id', 'DESC');
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class, 'user_id', 'id');
    }


    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class, 'user_id', 'id');
    }



    //===================================================================================================================
    // =========================================== Accessories ==============================================
    //===================================================================================================================
    public function getUserTypeAttribute($value)
    {
        if ($value == 1) {
            return "Real Estate Office";
        }
        if ($value == 2) {
            return "Real Estate Owner";
        }
        if ($value == 3) {
            return "Real Estate Seeker";
        }
    }




    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return "Pending";
        }
        if ($value == 2) {
            return "Accept";
        }
        if ($value == 3) {
            return "Reject";
        }
        if ($value == 4) {
            return "Active";
        }
        if ($value == 5) {
            return "Inactive";
        }
    }

    public function getIsVerifiedAttribute($value)
    {
        if ($value == 1) {
            return "Not Verified";
        }
        if ($value == 2) {
            return "Verified";
        }
       
    }


}
