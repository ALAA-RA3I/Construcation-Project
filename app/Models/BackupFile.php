<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BackupFile extends BaseModel
{
    protected $fillable = [
        'project_file_id',
    ];

    public function projectFile()
    {
        return $this->belongsTo(ProjectFile::class,'project_file_id');
    }
}
