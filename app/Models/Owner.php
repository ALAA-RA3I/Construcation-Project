<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends BaseModel
{
    protected $fillable = [
        'user_id',
        'address',
        'national_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ownerPayments() : HasMany
    {
        return $this->hasMany(Owner::class,'owner_id');
    }

    public function projects() : HasMany
    {
        return $this->hasMany(Project::class,'owner_id');
    }
    public function participant()
    {
        return $this->morphMany(ProjectParticipant::class, 'participant');
    }
}
