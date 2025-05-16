<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'status',
    ];

    public function ownerPayments() : HasMany 
    {
        return $this->hasMany(Owner::class,'owner_id');
    }

    public function projects() : HasMany
    {
        return $this->hasMany(Project::class,'owner_id');
    }
}
