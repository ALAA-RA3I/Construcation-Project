<?php

namespace App\Models;

use App\Domain\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends BaseModel
{
    protected $fillable = [
        'description',
        'status',
        'task_id',
        'created_by',
        'assigned_to',
    ];
    protected function casts(): array
    {
        return [
            'status' => TicketStatusEnum::class,
            // other casts...
        ];
    }

    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class,'task_id');
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedParticipant(): BelongsTo
    {
        return $this->belongsTo(ProjectParticipant::class, 'assigned_to');
    }
}
