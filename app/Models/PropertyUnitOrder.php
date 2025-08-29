<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Enums\PropertUnitOrderStatusEnum;

class PropertyUnitOrder extends BaseModel
{
    protected $fillable = [
        'property_book_id',
        'priority_number',
        'identity_file',
        'status',
        'note',
        'client_id',
        // حقول العقد
        'contract_file',
        'contract_hash',
        'contract_sent_at',
        // حقول التوقيع
        'signature_code',
        'signature_code_sent_at',
        'client_signed_at',
        'company_signed_at',
        // حقول الدفع
        'payment_intent_id',
        'payment_amount',
        'payment_completed_at',
        // حقول إضافية
        'activation_token',
        'activation_token_sent_at',
        'account_activated_at',
        'contract_signed_id'
    ];

    protected $casts = [
        'contract_sent_at' => 'datetime',
        'signature_code_sent_at' => 'datetime',
        'client_signed_at' => 'datetime',
        'company_signed_at' => 'datetime',
        'payment_completed_at' => 'datetime',
        'activation_token_sent_at' => 'datetime',
        'account_activated_at' => 'datetime',
        'payment_amount' => 'decimal:2',
        'status' => PropertUnitOrderStatusEnum::class,
    ];

    public function propertyBook(): BelongsTo
    {
        return $this->belongsTo(PropertyBook::class, 'property_book_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * التحقق من أن الطلب في حالة معينة
     */
    public function isStatus($status)
    {
        return $this->status === $status;
    }

    /**
     * التحقق من أن العميل وقع على العقد
     */
    public function isClientSigned()
    {
        return !is_null($this->client_signed_at);
    }

    /**
     * التحقق من أن الشركة وقعت على العقد
     */
    public function isCompanySigned()
    {
        return !is_null($this->company_signed_at);
    }

    /**
     * التحقق من اكتمال الدفع
     */
    public function isPaymentCompleted()
    {
        return !is_null($this->payment_completed_at);
    }

    /**
     * الحصول على رابط ملف العقد
     */
    public function getContractFileUrlAttribute()
    {
        return $this->contract_file ? asset('storage/' . $this->contract_file) : null;
    }
}
