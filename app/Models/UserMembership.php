<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    use HasFactory;
    protected $table = 'user_memberships';
    protected $fillable = [
        'user_id',
        'premium_membership_id',
        'number_of_ads',
        'expiry_date',
        'status',

    ];

    //======================================================================
    //==============================Relations===============================
    //======================================================================
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function premiumMembership()
    {
        return $this->belongsTo(PremiumMembership::class)->withTrashed();
    }


    //======================================================================
    //==============================Accessories=================================

    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } else if ($value == 2) {
            return 'Inactive';
        }
    }
}
