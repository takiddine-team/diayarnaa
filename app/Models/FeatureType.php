<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureType extends Model
{
  use HasFactory;
  use SoftDeletes;


  protected $fillable = [
    'name_en',
    'name_ar',
    'status',
  ];

  //======================================================================
  //============================== Relations  ============================

  public function features()
  {
    return $this->hasMany(Feature::class);
  }

  public function subCategories()
  {
    return $this->belongsToMany(SubCategory::class, 'feature_type_sub_categories', 'feature_type_id', 'sub_category_id');
  }


  //======================================================================
  //============================== Accessors =============================
  public function getStatusAttribute($value)
  {
    if ($value == 1) {
      return 'Active';
    } else if ($value == 2) {
      return 'Inactive';
    }
  }
}
