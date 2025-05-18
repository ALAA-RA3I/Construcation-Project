<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectBill extends BaseModel
{
    protected $fillable = [
        'cost',
        'date_of_payment',
        'project_id',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function projectBillsDetails() : HasMany
    {
        return $this->hasMany(ProjectBillDetail::class,'project-bills-id');
    }
}
