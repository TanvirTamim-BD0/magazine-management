<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_category_id',
        'name',
        'assign_to',
        'deadline',
        'remark',
        'reply_comment',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function assignData()
    {
        return $this->belongsTo(User::class,'assign_to');
    }

    public function taskCategoryData()
    {
        return $this->belongsTo(TaskCategory::class,'task_category_id');
    }

}