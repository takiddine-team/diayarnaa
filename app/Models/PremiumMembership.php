<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PremiumMembership extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "premium_memberships";

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'price',
        'number_days_ad',
        'number_days_membership',
        'number_of_ads',
        'status',
        'featured_type',
        'user_type',
        'unlimited_status'

    ];



    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================

    public function userMemberships()
    {
        return $this->hasMany(UserMembership::class);
    }


    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class, 'premium_membership_id', 'id');
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

    public function getFeaturedTypeAttribute($value)
    {
        if ($value == 1) {
            return 'True';
        } elseif ($value == 2) {
            return 'False';
        }
    }

    public function getUserTypeAttribute($value)
    {
        if ($value == 1) {
            return "Real Estate Office";
        }
        if ($value == 2) {
            return "Real Estate Owner";
        }
        if ($value == 3) {
            return "Real Estate Seeker";
        }
    }

    public function getUnlimitedStatusAttribute($value)
    {
        if ($value == 1) {
            return "True";
        }
        if ($value == 2) {
            return "False";
        }
    }
}
