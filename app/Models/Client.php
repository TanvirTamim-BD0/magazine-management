<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'designation_id',
        'company_id',
        'address',
        'country',
        'website',
        'email',
        'phone',
        'others_phone',
        'others_email',
        'area_code'
    ];
    
    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function designationData()
    {
        return $this->belongsTo(Designation::class,'designation_id');
    }

    public function companyData()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function categoryData()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function areaCodeData()
    {
        return $this->belongsTo(AreaCode::class,'area_code');
    }

}
