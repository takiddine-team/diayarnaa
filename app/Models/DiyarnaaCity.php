<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiyarnaaCity extends Model
{
    use HasFactory;
    protected $table = 'diyarnaa_cities';
    protected $fillable = [
        'diyarnaa_country_id',
        'name_en',
        'name_ar',
        'status',

    ];
    //=======================================================================
    //============================ Relations ================================
    //=======================================================================
    public function country()
    {
        return $this->belongsTo(DiyarnaaCountry::class,'diyarnaa_country_id');
    }

    public function diyarnaaRegions()
    {
        return $this->hasMany(DiyarnaaRegion::class,'diyarnaa_city_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'diyarnaa_city_id');
    }

    public function slideHomes()
    {
        return $this->hasMany(HomeSlider::class, 'diyarnaa_city_id');
    }



    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'sub_category_id');
    }

    public function customerRequestAndOffers()
    {
        return $this->hasMany(CustomerRequestAndOffer::class, 'diyarnaa_city_id');
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
