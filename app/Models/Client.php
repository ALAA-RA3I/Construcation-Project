<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens,SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'national_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function propertyUnits()
    {
        return $this->hasMany(PropertyUnit::class);
    }

    public function propertyBooks()
    {
        return $this->hasManyThrough(PropertyBook::class, PropertyUnit::class, 'client_id', 'id', 'id', 'property_book_id');
    }

    public function propertyUnitOrders()
    {
        return $this->hasMany(PropertyUnitOrder::class);
    }
}
