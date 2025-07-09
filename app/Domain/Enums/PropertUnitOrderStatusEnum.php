<?php declare(strict_types=1);

namespace App\Domain\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static InProgress()
 * @method static static Done()
 * @method static static WaitingForTicket()
 * @method static static WaitingApproval()
 */
final class PropertUnitOrderStatusEnum extends Enum
{
    const Pending = 'pending';
    const Approved = 'approved';
    const Rejected = 'rejected';
}
