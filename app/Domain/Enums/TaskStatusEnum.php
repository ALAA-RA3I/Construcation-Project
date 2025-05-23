<?php declare(strict_types=1);

namespace App\Domain\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TaskStatusEnum extends Enum
{
    const ToDo = 'ToDo';
    const Doing = 'Doing';
    const PendingApproval = 'pendingApproval'; // Keep spelling same as DB if needed
    const Done = 'Done';
}
