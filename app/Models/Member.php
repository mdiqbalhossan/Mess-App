<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            $this->generateUniqueID();
        });

        static::updating(function ($member) {
            $this->generateUniqueID();
        });
    }

    public function generateUniqueID()
    {
        // Generate a 2-digit random number
        $randomNumber = str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
        if($this->u_id != null){
            $u_id = $this->u_id;
        }else{
            $u_id = $this->room_no.$randomNumber;
        }
//        // Set the u_id field based on room_no + 2-digit number
//        $this->u_id = $this->room_no . $randomNumber;
    }
}
