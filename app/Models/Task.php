<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'assign_date',
        'assign_by',
        'deadline',
        'priority',
        'follow_up',
        'remark',
        'admin_comment',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function assignData()
    {
        return $this->belongsTo(User::class,'assign_by');
    }

}
