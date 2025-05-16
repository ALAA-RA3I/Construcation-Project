<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    protected $fillable = [
        'path',
        'description',
        'is_main',
        'type',
        'project_id',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
