<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraFeature extends Model
{
    use HasFactory;
    protected $table = 'extra_features';
    protected $fillable = [
        'advertisement_id',
        'title_ar',
        'title_en',
    ];
//=====================================================
//==========================Relations==================
    public function Advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
