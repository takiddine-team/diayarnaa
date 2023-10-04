<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnqueryRequest extends Model
{
    use HasFactory;
    protected $table = 'enquery_requests';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'real_estate_office_id',
        'advertisement_id',
        'diyarnaa_country_id',
    ];

    public function real_estate_office()
    {
        return $this->belongsTo(User::class, 'real_estate_office_id');
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id');
    }

    public function diyarnaaCountry()
    {
        return $this->belongsTo(DiyarnaaCountry::class, 'diyarnaa_country_id');
    }
}
