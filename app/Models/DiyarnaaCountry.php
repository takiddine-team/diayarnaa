<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiyarnaaCountry extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'diyarnaa_countries';
    protected $fillable = [
        'country_key',
        'country_code',
        'public_country_id',
        'name_en',
        'name_ar',
        'flag',
        'image',
        'public_currency_id',
        'status',
    ];

    //=======================================================================
    //============================ Relations ================================
    //=======================================================================

    public function diyarnaaCities()
    {
        return $this->hasMany(DiyarnaaCity::class, 'diyarnaa_country_id');
    }

    public function currency()
    {
        return $this->belongsTo(PublicCurrency::class, 'public_currency_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'diyarnaa_country_id');
    }

    public function slideHomes()
    {
        return $this->hasMany(HomeSlider::class, 'diyarnaa_country_id');
    }

    public function websiteBrokers()
    {
        return $this->hasMany(WebsiteBroker::class, 'diyarnaa_country_id')->where('status', 4)->where('image','!=' , null);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'sub_category_id');
    }
    
    public function customerRequestAndOffers()
    {
        return $this->hasMany(CustomerRequestAndOffer::class, 'diyarnaa_country_id');
    }

    public function enqueryRequests()
    {
        return $this->hasMany(EnqueryRequest::class, 'diyarnaa_country_id');
    }


    //=======================================================================
    //============================ Accessors ================================
    //=======================================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } else if ($value == 2) {
            return 'Inactive';
        }
    }
}
