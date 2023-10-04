<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = 'contact_us';
    protected $fillable = [
        'phone',
        'phone_two',
        'email',
        'url_map',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'messanger',
        'youtube',
        'background_image',
      
    ];
}
