<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyBook extends BaseModel
{
    protected $fillable = [
        'project_id',
        'model',
        'space',
        'price',
        'first_payment_amount',
        'description',
        'payment_period',
        'available_units',
        'number_of_rooms',
        'number_of_bathrooms',
        'direction',
        'diagram_image',
    ];

    /**
     * العلاقة مع المشروع
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * العلاقة مع الشقق (PropertyUnits) - إن كنت ستنشئها لاحقًا
     */
    public function propertyUnits()
    {
        return $this->hasMany(PropertyUnit::class);
    }

    public function clients()
    {
        return $this->hasManyThrough(Client::class, PropertyUnit::class, 'property_book_id', 'id', 'id', 'client_id');
    }

    /**
     * العلاقة مع الفواتير أو الأقساط - إن وجدت
     */
    public function bills()
    {
        return $this->hasMany(PropertyBookBill::class);
    }
    public function orders()
    {
        return $this->hasMany(PropertyUnitOrder::class);
    }
}
