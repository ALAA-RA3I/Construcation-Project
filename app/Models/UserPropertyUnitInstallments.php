<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPropertyUnitInstallments extends BaseModel
{
    protected $fillable = [
        'property_unit_id',
        'client_id',
        'amount',
        'due_date',
        'is_paid',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_paid' => 'boolean',
        'amount' => 'decimal:2',
    ];

    // العلاقة مع الشقة
    public function propertyUnit()
    {
        return $this->belongsTo(PropertyUnit::class);
    }

    // العلاقة مع العميل
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
