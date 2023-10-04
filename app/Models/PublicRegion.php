<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicRegion extends Model
{
    use HasFactory;

    protected $table = 'public_regions';
    protected $fillable = [
        'country_id',
        'country_key',
        'name_en',
        'name_ar',
    ];


    // ===================================================================================================================
    // =========================================== Relationship Section ==================================================
    // ===================================================================================================================

    // With Public Country table :
    // ===================================================================================================================
    public function country()
    {
        return $this->belongsTo(PublicCountry::class, 'country_id');
    }
    // Relation With Individual  Table
    //Created By : Qusai Al-Nablse
    public function Individual()
    {
        return $this->hasMany(Individual::class);
    }
    // Relation With Company Job Table
    //Created By : Qusai Al-Nablse
    public function Job()
    {
        return $this->hasMany(Job::class, 'region_id')->where('job_status','=',2);
    }
    // Relation With SelectedJob Table
    //Created By : Qusai Al-Nablse
    public function SelectedJob()
    {
        return $this->hasMany(SelectedJob::class);
    }
    // Relation With SpecialJob Table
    //Created By : Qusai Al-Nablse
    public function SpecialJob()
    {
        return $this->hasMany(SpecialJob::class);
    }

    public function universities()
    {
        return $this->hasMany(PublicUniversities::class);
    }
    
}
