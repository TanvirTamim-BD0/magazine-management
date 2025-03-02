<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'name',
        'date',
        'image',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function clientData()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

}
