<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskContainer extends Model
{
    protected $fillables = [
        'quantity',
        'task_id',
        'items_id',
    ];

    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class,'task_id');
    }

    public function item() : BelongsTo
    {
        return $this->belongsTo(Item::class,'items_id');
    }


}
