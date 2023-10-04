<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = 'abouts';
    protected $fillable = [
        'about_description_en',
        'about_description_ar',
        'about_image',

        'our_message_en',
        'our_message_ar',
        'our_message_image',

        'our_vission_en',
        'our_vission_ar',
        'our_vission_image',

        'our_value_en',
        'our_value_ar',
        'our_value_image',

        'background_aboutus_image',
        'background_company_image',
   
    ];
}
