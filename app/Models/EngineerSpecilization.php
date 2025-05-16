<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EngineerSpecilization extends Model
{
    protected $fillable = ['name_of_major'];

    public function employees() :HasMany
    {
        return $this->hasMany(Employee::class,'engineer_specilization_id');
    }
}
