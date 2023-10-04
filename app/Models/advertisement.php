<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'advertisements';

    protected $fillable = [
        'user_id',
        'target_id',
        'main_category_id',
        'sub_category_id',
        'construction_age',
        'land_area',
        'real_estate_status',
        'number_of_rooms',
        'number_of_bathrooms',
        'diyarnaa_country_id',
        'diyarnaa_city_id',
        'diyarnaa_region_id',
        'street',
        'url_map',
        'address',
        'price',
        'area',
        'real_estate_formula',
        'main_image',
        'video',
        'ad_reference',
        'status',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'code',
        'real_estate_agent_name',
        'edit_balance',
        'expiry_date',
        'contact_method',
        'area_type_id',
    ];

    //=======================================================================
    //========================== Relations =================================
    //=======================================================================
    public function feature()
    {
        return $this->belongsTo(Feature::class, 'area_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function target()
    {
        return $this->belongsTo(Target::class, 'target_id', 'id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function diyarnaaCountry()
    {
        return $this->belongsTo(DiyarnaaCountry::class, 'diyarnaa_country_id', 'id');
    }

    public function diyarnaaCity()
    {
        return $this->belongsTo(DiyarnaaCity::class, 'diyarnaa_city_id', 'id');
    }

    public function diyarnaaRegion()
    {
        return $this->belongsTo(DiyarnaaRegion::class, 'diyarnaa_region_id', 'id');
    }

    public function advertisementImage()
    {
        return $this->hasMany(AdvertisementImage::class, 'advertisement_id', 'id');
    }
    public function constructionAge()
    {
        return $this->belongsTo(Feature::class, 'construction_age', 'id');
    }
    public function landArea()
    {
        return $this->belongsTo(Feature::class, 'land_area', 'id');
    }
    public function realestateStatus()
    {
        return $this->belongsTo(Feature::class, 'real_estate_status', 'id');
    }
    public function numberOfRoom()
    {
        return $this->belongsTo(Feature::class, 'number_of_rooms', 'id');
    }
    public function numberOfBathroom()
    {
        return $this->belongsTo(Feature::class, 'number_of_bathrooms', 'id');
    }

    public function extraFeatures()
    {
        return $this->hasMany(ExtraFeature::class, 'advertisement_id', 'id');
    }

    public function advertisementEditRequests()
    {
        return $this->hasMany(AdvertisementEditRequest::class, 'advertisement_id', 'id');
    }

    public function enqueryRequests()
    {
        return $this->hasMany(EnqueryRequest::class, 'advertisement_id', 'id');
    }

    public function favouriteAdvertisements()
    {
        return $this->hasMany(FavouriteAdvertisement::class, 'advertisement_id', 'id');
    }

    public function mails()
    {
        return $this->hasMany(Mail::class, 'advertisement_id', 'id');
    }

    //=======================================================================
    //==========================  status ==============================
    //=======================================================================

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
        if ($value == 6) {
            return "Accept with Conditions";
        }
    }

    public function getContactMethodAttribute($value)
    {
        if ($value == 1) {
            return @trans("front.Mobile");
        }
        if ($value == 2) {
            return @trans("front.Whatsapp");

        }
        if ($value == 3) {
            return @trans("front.Email");

        }
        if ($value == 4) {
            return @trans("front.EmailOrWhatsappOrMobile");
        }
    }
}
