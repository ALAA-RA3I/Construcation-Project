<?php

namespace App\Models;

use App\Domain\Enums\MediaTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends BaseModel
{
    protected $fillable = [
        'path',
        'description',
        'is_main',
        'type',
        'project_id',
    ];
    protected function casts(): array
    {
        return [
            'type' => MediaTypeEnum::class,
            'is_main' => 'boolean',
            // other casts...
        ];
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
