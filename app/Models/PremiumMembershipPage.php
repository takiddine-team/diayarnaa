<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumMembershipPage extends Model
{
    use HasFactory;
    protected $table = 'premium_membership_pages';
    protected $fillable = [
        'description_ar',
        'description_en',
        'image',
    ];
}
