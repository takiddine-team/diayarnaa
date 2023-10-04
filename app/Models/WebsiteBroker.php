<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebsiteBroker extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'diyarnaa_country_id',
        'status',
        'image',
        'file',
        'last_name',
        'email',
        'phone',
        'diyarnaa_city_id',
        'details',
    ];

    //======================================================================
    // ==============================Relationships
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
    //============================Accessora=============================
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
}
