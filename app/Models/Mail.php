<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'mails';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sender_type',
        'receiver_type',
        'advertisement_id',
        'details',
        'file',
        'email_type',
        'deleter_type',
        'is_read',
    ];
    //=======================================================================
    //========================== Relations =================================
    //=======================================================================
    public function userSender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function userReceiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function adminSender()
    {
        return $this->belongsTo(Admin::class, 'sender_id', 'id');
    }

    public function adminReceiver()
    {
        return $this->belongsTo(Admin::class, 'receiver_id', 'id');
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }

    //=======================================================================
    //========================== Accessory =================================
    //=======================================================================
    public function getSenderTypeAttribute($value)
    {
        if ($value == 1) {
            return 'Admin';
        } elseif ($value == 2) {
            return 'User';
        }
    }

    public function getReceiverTypeAttribute($value)
    {
        if ($value == 1) {
            return 'Admin';
        } elseif ($value == 2) {
            return 'User';
        }
    }

    public function getEmailTypeAttribute($value)
    {
        if ($value == 1) {
            return 'Chat';
        } elseif ($value == 2) {
            return 'Update Request';
        } elseif ($value == 3) {
            return 'Accept';
        } elseif ($value == 4) {
            return 'Reject';
        } elseif ($value == 5) {
            return 'Accept with Conditions';
        }elseif ($value == 6) {
            return 'Advertisements that match the added Search';
        }
    }

    public function getDeleterTypeAttribute($value)
    {
        if ($value == 1) {
            return "Sender";
        }
        else if ($value == 2) {
            return "Receiver";
        }
        else if($value == 3){
            return "Both";
        }
    }

    public function getIsReadAttribute($value)
    {
        if ($value == 1) {
            return "Yes";
        }
        else if ($value == 2) {
            return "No";
        }
    }
}
