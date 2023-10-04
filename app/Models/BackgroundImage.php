<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{
    use HasFactory;
    protected $table = 'background_images';
    protected $fillable = [
        'website_broker',
        'complaint',
        'job',
        'term_condition',
        'privacy_policy',
        'user_signup',
        'user_login',
        'advertisement_details',
        'user_dashboard',
        'customer_opinion',
    ];
}
