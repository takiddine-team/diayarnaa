<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "main_categories";
    protected $fillable = [
        'name_en',
        'name_ar',
        'status',

    ];


    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================
    public function features(){
        $this->belongsToMany(Feature::class, 'category_features', 'category_id', 'feature_id');
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function advertisements(){
        return $this->hasMany(Advertisement::class, 'main_category_id');
    }

    public function customerRequestAndOffers(){
        return $this->hasMany(CustomerRequestAndOffer::class, 'category_id');
    }



    // ===================================================================================================================
    // ============================================= Accessors Section ===================================================
    // ===================================================================================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } elseif ($value == 2) {
            return 'Inactive';
        }
    }
}
