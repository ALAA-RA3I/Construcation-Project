<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Engineer extends BaseModel
{
    protected $fillable = [
        'user_id',
        'years_of_experience',
        'engineer_specialization_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function specialization()
    {
        return $this->belongsTo(EngineerSpecialization::class, 'engineer_specialization_id');
    }
    public function participant()
    {
        return $this->morphMany(ProjectParticipant::class, 'participant');
    }

}
