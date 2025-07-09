<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends BaseModel
{

    protected $fillable = [
        'property_book_id',
        'unit_number',
        'floor',
        'client_id',
    ];

    /**
     * العلاقة مع نموذج الشقة (property_book)
     */
    public function propertyBook()
    {
        return $this->belongsTo(PropertyBook::class);
    }

    /**
     * العلاقة مع المستخدم الذي حجز الشقة
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function userInstallments()
    {
        return $this->hasMany(UserPropertyUnitInstallments::class);
    }
}
