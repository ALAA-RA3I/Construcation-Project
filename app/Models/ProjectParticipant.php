<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class ProjectParticipant extends BaseModel
{
    protected $fillable = [
        'project_id',
        'participant_id',
        'participant_type',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function participant(): MorphTo
    {
        return $this->morphTo();
    }

    public function projectFiles() : HasMany
    {
        return $this->hasMany(ProjectFile::class,'project_participant_id');
    }

    public function task() : HasMany
    {
        return $this->hasMany(Task::class,'employee_assignded');
    }

    public function taskSupervisor() : HasMany
    {
        return $this->hasMany(Task::class,'supervisor_id');
    }
}
