<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequestAndOfferImage extends Model
{
    use HasFactory;
    protected $table = 'customer_request_and_offer_images';
    protected $fillable = [
        'image',
        'customer_request_and_offer_id',
    ];
    //===============================================
    //================= Relations ===================
    //===============================================
    public function customerRequestAndOffer()
    {
        return $this->belongsTo(CustomerRequestAndOffer::class);
    }
}
