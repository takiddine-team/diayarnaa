<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicCountry extends Model
{
    use HasFactory;

    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = 'public_countries';
    protected $fillable = [
        'country_key',
        'name_en',
        'name_ar',
    ];

    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================
    
    public function students(){
        return $this->hasMany(Student::class);
    }
    // With Public Region table :
    // ===================================================================================================================
    public function regions()
    {
        return $this->hasMany(PublicRegion::class, 'country_id');
    }

    public function countries()
    {
        return $this->hasMany(Country::class, 'country_id');
    }

}
