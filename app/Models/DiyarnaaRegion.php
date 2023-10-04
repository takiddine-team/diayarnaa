<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiyarnaaRegion extends Model
{
    use HasFactory;
    protected $table = 'diyarnaa_regions';
    protected $fillable = [
        'diyarnaa_city_id',
        'name_en',
        'name_ar',
        'status',

    ];


    //=======================================================================
    //============================ Relations ================================
    //=======================================================================
    public function city()
    {
        return $this->belongsTo(DiyarnaaCity::class, 'diyarnaa_city_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function customerRequestAndOffers()
    {
        return $this->hasMany(CustomerRequestAndOffer::class);
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
