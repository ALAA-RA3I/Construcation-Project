<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectBill extends BaseModel
{
    protected $fillable = [
        'description',
        'date_of_payment',
        'project_id',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function billsDetails() : HasMany
    {
        return $this->hasMany(ProjectBillDetail::class,'project_bill_id');
    }
    public function getTotalCostAttribute()
    {
        return $this->billsDetails->sum('cost');
    }
}
