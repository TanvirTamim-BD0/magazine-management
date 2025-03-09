<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public static function pendingMagazinesCount($magazineId)
    {
        $data = MagazineSend::where('magazine_id', $magazineId)->where('send_status','Pending')->count();
        return $data;
    }

    public static function sendingMagazinesCount($magazineId)
    {
        $data = MagazineSend::where('magazine_id', $magazineId)->where('send_status','Sending Complete')->count();
        return $data;
    }

    public static function receiveMagazinesCount($magazineId)
    {
        $data = MagazineSend::where('magazine_id', $magazineId)->where('send_status','Received')->count();
        return $data;
    }

}
