<?php

namespace App\Domain\Services\Contracts;

use App\Models\PropertyUnitOrder;

interface EmailServiceServiceInterface
{
    /**
     * إرسال إيميل تفعيل الحساب
     */
    public function sendAccountActivationEmail(PropertyUnitOrder $order);

    /**
     * إرسال إيميل العقد
     */
    public function sendContractEmail(PropertyUnitOrder $order);

    /**
     * إرسال رمز التوقيع السري
     */
    public function sendSignatureCodeEmail(PropertyUnitOrder $order);

    /**
     * إرسال إيميل تأكيد اكتمال العقد
     */
    public function sendContractFinalizedEmail(PropertyUnitOrder $order);
}
