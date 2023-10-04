<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementEditRequest extends Model
{
    use HasFactory;
    protected $table = 'advertisement_edit_requests';

    protected $fillable = [
        'advertisement_id',
        'user_id',
        'status',
    ];

    //=======================================================================
    //========================== Relations =================================
    //=======================================================================

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //=======================================================================
    //========================== Accessors =================================
    //=======================================================================
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Pending';
        } else if ($value == 2) {
            return 'Accepted';
        } else if ($value == 3) {
            return 'Rejected';
        }
    }
}
