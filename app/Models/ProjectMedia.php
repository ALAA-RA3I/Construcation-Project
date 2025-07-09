<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMedia extends BaseModel
{
    protected $fillable = [
        'project_id',
        'path_file'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
