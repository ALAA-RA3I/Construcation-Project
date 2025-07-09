<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectNews extends BaseModel
{
    protected $fillable = [
        'project_id',
        'path_file',
        'description'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
