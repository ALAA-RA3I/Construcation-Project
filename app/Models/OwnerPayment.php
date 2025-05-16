<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OwnerPayment extends Model
{
    protected $fillable = [
        'cost',
        'date_of_payment',
        'owner_id',
    ];


    public function owner() :BelongsTo 
    {
        return $this->belongsTo(Owner::class,'owner_id');
    }
}
