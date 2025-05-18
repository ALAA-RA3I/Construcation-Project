<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyBook extends BaseModel
{
    protected $fillable = [
        'area',
        'number_of_room',
        'floor',
        'cost',
        'description',
        'payment_period',
        'project_id',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
