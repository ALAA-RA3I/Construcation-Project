<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectSalesDetails extends BaseModel
{
    protected $fillable = [
        'project_id',
        'main_title',
        'marketing_description',
        'location_link',
        'address',
        'video_url',
        'main_image',
        'diagram_image',
        'type',
        'progress_status',
        'expected_cost',
        'owner_id',
        'consulting_company_id',
    ];
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
