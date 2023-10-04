<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'targets';

    protected $fillable = [
        'name_en',
        'name_ar',
        'status',

    ];

    public function customerRequestAndOffers()
    {
        return $this->hasMany(CustomerRequestAndOffer::class);
    }
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } elseif ($value == 2) {
            return 'Inactive';
        }
    }
}
