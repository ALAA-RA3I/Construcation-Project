<?php

namespace App\Models;

use App\Domain\Enums\ProgressStatusEnum;
use App\Domain\Enums\PropertyTypeEnum;
use App\Domain\Enums\StatusOfSaleEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends BaseModel
{
    protected $fillable = [
        'title',
        'project_code',
        'description',
        'location',
        'area',
        'number_of_floor',
        'status_of_sale',
        'expected_date_of_completed',
        'type',
        'progress_status',
        'expected_cost',
        'owner_id',
        'consulting_company_id',
    ];

    protected function casts(): array
    {
        return [
            'status_of_sale' => StatusOfSaleEnum::class,
            'type' => PropertyTypeEnum::class,
            'progress_status' => ProgressStatusEnum::class,
        ];
    }
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
