<?php

namespace App\Models;

use App\Domain\Enums\PropertUnitOrderStatusEnum;
use Illuminate\Database\Eloquent\Model;

class PropertyUnitOrders extends BaseModel
{
    protected $fillable = [
        'property_unit_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'identity_file',
        'clearance_certificate',
        'status',
        'note',
        'client_id',
    ];
    protected function casts(): array
    {
        return [
            'status' => PropertUnitOrderStatusEnum::class,
        ];
    }

    // العلاقة مع الشقة
    public function propertyUnit()
    {
        return $this->belongsTo(PropertyUnit::class);
    }

    // يمكن إنشاء اسم كامل من الحقول الثلاثة
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
