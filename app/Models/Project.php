<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'project_code',
        'description',
        'location',
        'area',
        'number_of_floor',
        'stauts_of_sale',
        'expected_date_of_completed',
        'type',
        'progress_status',
        'expected_cost',
        'owner_id',
        'consulting_company_id',
    ];

    public function owners(): BelongsTo
    {
        return $this->belongsTo(Owner::class,'owner_id');
    }

    public function consultingCompany(): BelongsTo
    {
        return $this->belongsTo(ConsultingCompany::class,'consulting_company_id');
    }

    public function projectStage() : HasMany
    {
        return $this->hasMany(ProjectStage::class,'project_id');
    }

    public function projectBills() : HasMany
    {
        return $this->hasMany(ProjectBill::class,'project_id');
    }
    
    public function projectFiles() : HasMany
    {
        return $this->hasMany(ProjectFile::class,'project_id');
    }

    public function projectContainer() : HasMany
    {
        return $this->hasMany(ProjectContainer::class,'project_id');
    }
    
    public function media() : HasMany
    {
        return $this->hasMany(Media::class,'project_id');
    }

    public function propertyBook() : HasMany
    {
        return $this->hasMany(PropertyBook::class,'project_id');
    }

}
