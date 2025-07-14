<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyUnitOrder extends BaseModel
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

    public function propertyUnit(): BelongsTo
    {
        return $this->belongsTo(PropertyUnit::class, 'property_unit_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
