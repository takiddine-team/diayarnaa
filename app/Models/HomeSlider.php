<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeSlider extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company_name_ar',
        'company_name_en',
        'diyarnaa_country_id',
        'diyarnaa_city_id',
        'image',
        'license_image',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'phone',
        'email',
        'status',
        'expire_date',
        'user_type',
    ];

    //======================================================================
    //==============================Relations===============================
    //======================================================================

    public function diyarnaaCountry()
    {
        return $this->belongsTo(DiyarnaaCountry::class, 'diyarnaa_country_id');
    }

    public function diyarnaaCity()
    {
        return $this->belongsTo(DiyarnaaCity::class, 'diyarnaa_city_id');
    }

    //======================================================================
    //==============================Accessors===============================
    //======================================================================

    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Pending';
        } 
        else if ($value == 2) {
            return 'Accept';
        }
        else if ($value == 3) {
            return 'Reject';
        }
        else if ($value == 4) {
            return 'Active';
        }
        else if ($value == 5) {
            return 'Inactive';
        }
    }

    public function getUserTypeAttribute($value)
    {
        if ($value == 1) {
            return 'Company';
        } else if ($value == 2) {
            return 'Office';
        }
    }

}
