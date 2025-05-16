<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class ConsultingEngineer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'consulting_companie_id',
        'engineer_specialization_id',
    ];

    public function consultingCompany() : BelongsTo
    {
        return $this->belongsTo(ConsultingCompany::class,'consulting_company_id');
    }

    public function participant() : MorphMany
    {
        return $this->morphMany(ProjectParticipant::class,'participant');
    }
}
