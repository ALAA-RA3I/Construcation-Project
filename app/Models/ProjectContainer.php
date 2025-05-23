<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectContainer extends BaseModel
{
    protected $fillable = [
        'quantity-available',
        'expected-quantity',
        'consumed-quantity',
        'remaining-quantity',
        'required-quantity',
        'items_id',
        'project_id',
    ];

    public function items() : BelongsTo
    {
        return $this->belongsTo(Item::class,'items_id');
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
