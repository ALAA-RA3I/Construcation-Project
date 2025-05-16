<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CompanyUser extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'years_of_experiense',
        'status',
        'engineer_specilization_id',
    ];


    public function engineerSpecialization() :BelongsTo
    {
        return $this->belongsTo(EngineerSpecilization::class ,'engineer_specilization_id');
    }

    public function participant() : MorphMany
    {
        return $this->morphMany(ProjectParticipant::class,'participant');
    }


}
