<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectFile extends BaseModel
{
    protected $fillable = [
        'file_path',
        'description',
        'project_id',
        'project_participant_id',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function projectParticipant() : BelongsTo
    {
        return $this->belongsTo(ProjectParticipant::class,'project_participant_id');
    }

    public function projectBackupFiles() : HasMany
    {
        return $this->hasMany(BackupFile::class,'project_file_id');
    }
}
