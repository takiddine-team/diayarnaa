<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteAdvertisement extends Model
{
    use HasFactory;
    protected $table =  'favourite_advertisements';
    protected $fillable = [
        'user_id',
        'advertisement_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id');
    }
}
