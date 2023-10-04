<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sub_categories';
    protected $fillable = [
        'category_id',
        'name_en',
        'name_ar',
        'status',
    ];
//=======================================================================
//========================== Relations =================================
    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'category_id');
    }

    public function featureTypes()
    {
        return $this->belongsToMany(FeatureType::class, 'feature_type_sub_categories', 'sub_category_id', 'feature_type_id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'sub_category_id');
    }

    public function customerRequestAndOffers()
    {
        return $this->hasMany(CustomerRequestAndOffer::class, 'sub_category_id');
    }
    
    


    // ===================================================================================================================
    // ============================================= Accessors Section ===================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } elseif ($value == 2) {
            return 'Inactive';
        }
    }
}
