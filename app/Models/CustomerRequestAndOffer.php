<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequestAndOffer extends Model
{
    use HasFactory;
    protected $table = 'customer_request_and_offers';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'target_id',
        'category_id',
        'sub_category_id',
        'diyarnaa_country_id',
        'diyarnaa_city_id',
        'diyarnaa_region_id',
        'price',
        'area',
        'address',
        'type',
        'video',
        'advertising',
    ];
//=====================================================
//================= Relations =========================
//=====================================================
public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}
    public function target()
    {
        return $this->belongsTo(Target::class, 'target_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function diyarnaaCountry()
    {
        return $this->belongsTo(DiyarnaaCountry::class, 'diyarnaa_country_id');
    }

    public function diyarnaaCity()
    {
        return $this->belongsTo(DiyarnaaCity::class, 'diyarnaa_city_id');
    }

    public function diyarnaaRegion()
    {
        return $this->belongsTo(DiyarnaaRegion::class, 'diyarnaa_region_id');
    }

    public function customerRequestAndOfferImages()
    {
        return $this->hasMany(CustomerRequestAndOfferImage::class, 'customer_request_and_offer_id');
    }
    //=======================================================================
    //========================== Accessors =================================
    public function getTypeAttribute($value)
    {
        if ($value == 1) {
            return 'Request';
        } elseif ($value == 2) {
            return 'Offer';
        }
    }
    
}
