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
        'description',
        'payment_period',
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
    public function units()
    {
        return $this->hasMany(PropertyUnit::class);
    }

    /**
     * العلاقة مع الفواتير أو الأقساط - إن وجدت
     */
    public function bills()
    {
        return $this->hasMany(PropertyBookBill::class);
    }
}
