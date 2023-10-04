<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscribe extends Model
{
    use HasFactory;
    protected $table = 'newsletter_subscribes';
    protected $fillable = [
        'email',
        'is_verified',
        'email_verified_at',
    ];


    

    //===================================================================================================================
    // =========================================== Accessories ==============================================
    //===================================================================================================================
    public function getIsVerifiedAttribute($value)
    {
        if ($value == 1) {
            return "Not Verified";
        }
        if ($value == 2) {
            return "Verified";
        }
       
    }
}
