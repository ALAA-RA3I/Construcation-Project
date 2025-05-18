<?php declare(strict_types=1);

namespace App\Domain\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProgressStatusEnum extends Enum
{
    const Initial = 'Initial';
    const InProgress = 'InProgress'; // Note the spelling
    const Done = 'Done';
}
