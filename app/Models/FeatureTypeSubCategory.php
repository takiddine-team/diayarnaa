<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureTypeSubCategory extends Model
{
    use HasFactory;

    protected $table = 'feature_type_sub_categories';

    protected $fillable = [
        'feature_type_id',
        'sub_category_id',
    ];
    
}
