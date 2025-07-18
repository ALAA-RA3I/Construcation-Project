<?php

namespace App\Domain\Services\Contracts;

use App\Models\PropertyUnitOrder;

interface ContractServiceServiceInterface
{
    /**
     * إنشاء ملف العقد
     */
    public function generateContract(PropertyUnitOrder $order);

    /**
     * التحقق من رمز التوقيع
     */
    public function verifySignatureCode(PropertyUnitOrder $order, $signatureCode);

    /**
     * توقيع العميل على العقد
     */
    public function signContractByClient(PropertyUnitOrder $order, $signatureCode);

    /**
     * توقيع الشركة على العقد
     */
    public function signContractByCompany(PropertyUnitOrder $order);

    /**
     * رفع العقد على البلوك تشين
     */
    public function uploadToBlockchain(PropertyUnitOrder $order);
}
