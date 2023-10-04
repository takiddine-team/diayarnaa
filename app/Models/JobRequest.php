<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;
    protected $table = 'job_requests';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'file',
        'job_id',
    ];

    //====================================================
    // ==================== Relations ====================
    //====================================================

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    
}
