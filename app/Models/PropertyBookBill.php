<?php

namespace App\Models;

use App\Domain\Enums\BookBillTypeEnum;
use Illuminate\Database\Eloquent\Model;

class PropertyBookBill extends BaseModel
{


    protected $fillable = [
        'property_book_id',
        'amount',
        'due_in_months',
        'type',
        'description',
    ];
    protected function casts(): array
    {
        return [
            'type' => BookBillTypeEnum::class,
        ];
    }

    /**
     * العلاقة مع النموذج
     */
    public function propertyBook()
    {
        return $this->belongsTo(PropertyBook::class);
    }
    public function userInstallments()
    {
        return $this->hasMany(UserPropertyUnitInstallments::class);
    }
}
