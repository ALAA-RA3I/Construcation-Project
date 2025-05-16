<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'dead_line',
        'status',
        'status_of_approval',
        'type_of_task',
        'note',
        'actual_date_of_closed',
        'stage_id',
        'employee_assignded',
        'supervisor_id',
    ];

    public function stage() : BelongsTo 
    {
        return $this->belongsTo(ProjectStage::class,'stage_id');
    }

    public function employeeAssigned() : BelongsTo
    {
        return $this->belongsTo(ProjectParticipant::class,'employee_assignded');
    }

    public function supervisor() : BelongsTo
    {
        return $this->belongsTo(ProjectParticipant::class,'supervisor_id');
    }

    public function taskContainer() : HasMany
    {
        return $this->hasMany(TaskContainer::class,'task_id');
    }

    public function ticket() : HasMany
    {
        return $this->hasMany(Ticket::class,'task_id');
    }
}
