<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EngineerSpecialization extends BaseModel
{
    protected $fillable = ['name_of_major'];

    public function engineer()
    {
        return $this->hasMany(Engineer::class,'engineer_specialization_id');
    }
    public function consultingengineer()
    {
        return $this->hasMany(ConsultingEngineer::class,'engineer_specialization_id');
    }
}
