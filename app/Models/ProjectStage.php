<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectStage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'expected_closed_date',
        'project_id',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function task() : HasMany {
        return $this->hasMany(Task::class,'stage_id');
    }
}
