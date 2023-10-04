<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;
    protected $table = 'opinions';
    protected $fillable = ['user_id', 'opinion', 'status'];
//==============================================================================================
//========================================== Relationships======================================
//==============================================================================================
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //====================================================
    // ==================== Accessors ====================
    //====================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } else if ($value == 2) {
            return 'Inactive';
        }
    }
}
