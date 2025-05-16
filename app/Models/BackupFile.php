<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BackupFile extends Model
{
    protected $fillable = [
        'project_file_id',
    ];

    public function projectFile() : BelongsTo {
        return $this->belongsTo(ProjectFile::class,'project_file_id');
    }
}
