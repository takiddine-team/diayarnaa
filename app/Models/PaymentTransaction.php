<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{

    use HasFactory;
    protected $table = "payment_transactions";

    protected $fillable = [
        'user_id',
        'premium_membership_id',
        'amount',
        'payment_id',
        'payment_status',
    ];




    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function premiumMembership()
    {
        return $this->belongsTo(PremiumMembership::class, 'premium_membership_id');
    }



    //====================================================
    // ==================== Accessors ====================
    //====================================================
    public function getPaymentStatusAttribute($value)
    {
        if ($value == 1) {
            return @trans("front.Created");
        } else if ($value == 2) {
            return @trans("front.Completed");
        }else if ($value == 3) {
            return @trans("front.Canceled");
        }
    }
}
