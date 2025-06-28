<?php declare(strict_types=1);

namespace App\Domain\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static InProgress()
 * @method static static Done()
 * @method static static WaitingForTicket()
 */
final class ApproveTaskEnum extends Enum
{
    const Pending = 'pending';
    const InProgress = 'in_progress';
    const Done = 'done';
    const WaitingForTicket = 'waiting_for_ticket';
}
