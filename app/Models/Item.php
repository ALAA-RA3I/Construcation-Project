<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends BaseModel
{
    protected $fillable = [
        'name',
        'category',
        'price',
    ];

    public function projectContainer() : HasMany
    {
        return $this->hasMany(ProjectContainer::class,'items_id');
    }

    public function taskContainer() : HasMany
    {
        return $this->hasMany(TaskContainer::class,'task_id');
    }
}
