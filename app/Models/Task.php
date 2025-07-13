<?php

namespace App\Models;

use App\Domain\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Enums\ApproveTaskEnum;

class Task extends BaseModel
{
    protected $fillable = [
        'dead_line',
        'status',
        'type_of_task',
        'note',
        'actual_date_of_closed',
        'stage_id',
        'employee_assigned',
        'supervisor_id',
        'priority',
        'start_date',
        'title',
        'description'
    ];
    protected function casts(): array
    {
        return [
            // 'status' => TaskStatusEnum::class,
            // 'status_of_approval' => ApproveTaskEnum::class,
            'dead_line' => 'date',
            'actual_date_of_closed' => 'date',
        ];
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(ProjectStage::class, 'stage_id');
    }

    public function employeeAssigned(): BelongsTo
    {
        return $this->belongsTo(ProjectParticipant::class, 'employee_assigned');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(ProjectParticipant::class, 'supervisor_id');
    }

    public function taskContainer(): HasMany
    {
        return $this->hasMany(TaskContainer::class, 'task_id');
    }

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class, 'task_id');
    }
}
