<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'searches';
    protected $fillable = [
        'user_id',
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
        'price_from',
        'price_to',
        'area_from',
        'area_to',
        'status',
        'code',
        'edit_balance',
        'expiry_date',
        'title',
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
    //=======================================================================
    //==========================  status ==============================
    //=======================================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return "Active";
        }
        if ($value == 2) {
            return "Inactive";
        }
    }
}
