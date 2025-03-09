<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineSend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'magazine_id',
        'client_id',
        'verify_code',
        'send_status',
        'receive_status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function clientData()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function magazineData()
    {
        return $this->belongsTo(Magazine::class,'magazine_id');
    }

    public static function getPendingMagazine($clientId)
    {
        $data = MagazineSend::where('client_id', $clientId)->where('send_status','Pending')->orderBy('id','desc')->first();
        
        return $data;
    }

    public static function getSingleMagazine($clientId)
    {
        $data = MagazineSend::where('client_id', $clientId)->orderBy('id','desc')->first();
        
        return $data;
    }
    

}