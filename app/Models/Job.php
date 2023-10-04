<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'jobs';

    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'file',
        'image',
        'expiry_date',
        'status'
    ];
    //====================================================
    // ==================== Relations ====================
    //====================================================

    public function job_requests()
    {
        return $this->hasMany(JobRequest::class);
    }

    //====================================================
    // ==================== Accessors ====================
    //====================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } else if($value == 2) {
            return 'Inactive';
        }
    }
}
