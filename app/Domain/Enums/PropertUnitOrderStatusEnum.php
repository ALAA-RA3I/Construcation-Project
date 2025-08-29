<?php

declare(strict_types=1);

namespace App\Domain\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Approved()
 * @method static static Rejected()
 * @method static static ContractReady()
 * @method static static PaymentPending()
 * @method static static PaymentCompleted()
 * @method static static ContractSigned()
 * @method static static ContractFinalized()
 */
final class PropertUnitOrderStatusEnum extends Enum
{
    const Pending = 'pending';
//    const Approved = 'approved';
    const Rejected = 'rejected';
//    const ContractReady = 'contract_ready';
    const PaymentPending = 'payment_pending';
    const PaymentCompleted = 'payment_completed';
    const ContractSigned = 'contract_signed';
    const ContractCanceled = 'contract_canceled';
//    const ContractFinalized = 'contract_finalized';
}
