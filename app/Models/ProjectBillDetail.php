<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectBillDetail extends BaseModel
{
    protected $fillable = [
        'item',
        'note',
        'cost',
        'project_bill_id',
    ];

    public function projectBill () : BelongsTo
    {
        return $this->belongsTo(ProjectBill::class,'project_bills_id');
    }
}
