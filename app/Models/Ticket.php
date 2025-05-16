<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'description',
        'status',
        'task_id',
    ];

    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class,'task_id');
    }
}
