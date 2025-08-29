<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends BaseModel
{

    protected $fillable = [
        'property_book_id',
        'client_id',
        'first_payment_date'

    ];
    
    /**
     * العلاقة مع نموذج الشقة (property_book)
     */
    public function propertyBook()
    {
        return $this->belongsTo(PropertyBook::class);
    }

    /**
     * العلاقة مع العميل (Client)
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
