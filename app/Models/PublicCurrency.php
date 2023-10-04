<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicCurrency extends Model
{
    use HasFactory;

    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = 'public_currencies';
    protected $fillable = [
        'code',
        'name_en',
        'name_ar',
    ];



    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================

 
    // Relation With DiyarnaaCountry Table
    //Created By : lujain Smadi
    public function DiyarnaaCountries()
    {
        return $this->hasMany(DiyarnaaCountry::class);
    }
}
