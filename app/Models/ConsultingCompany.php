<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsultingCompany extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'focal_point_first_name',
        'focal_point_last_name',
        'address',
        'phone_number',
        'land_line',
        'license_number',
    ];

    public function consultingEngineer() : HasMany
    {
        return $this->hasMany(ConsultingEngineer::class,'consulting_company_id');
    }

    public function projects() : HasMany
    {
        return $this->hasMany(Project::class,'consulting_company_id');
    }
}
