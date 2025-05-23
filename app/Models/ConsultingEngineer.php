<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class ConsultingEngineer extends BaseModel
{
    protected $fillable = [
        'user_id',
        'consulting_company_id',
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

    public function consultingCompany() : BelongsTo
    {
        return $this->belongsTo(ConsultingCompany::class,'consulting_company_id');
    }

    public function participant() : MorphMany
    {
        return $this->morphMany(ProjectParticipant::class,'participant');
    }
}
