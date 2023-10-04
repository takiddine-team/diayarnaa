<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = "admins";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',

    ];


    // ===================================================================================================================
    // ============================================== Relations Section ===================================================
    // ===================================================================================================================



    public function mailSender()
    {
        return $this->hasMany(Mail::class, 'sender_id', 'id')->where([
            ['sender_id', 1],
            ['sender_type', 1],
            ['deleter_type', 2],
        ])->orWhere([
            ['sender_id', 1],
            ['sender_type', 1],
            ['deleter_type', null],
        ])->orderBy('id', 'DESC');
    }

    public function mailReceiver()
    {
        return $this->hasMany(Mail::class, 'receiver_id', 'id')->where([
            ['receiver_id', 1],
            ['receiver_type', 1],
            ['deleter_type', 1],
        ])->orWhere([
            ['receiver_id', 1],
            ['receiver_type', 1],
            ['deleter_type', null],
        ])->orderBy('id', 'DESC');
    }

    //=======================================================================
    //========================== Accessors =================================
    //=======================================================================
    public function getTypeAttribute($value)
    {
        if ($value == 1) {
            return 'Admin';
        } else if ($value == 2) {
            return 'Employee';
        } 
    }




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
