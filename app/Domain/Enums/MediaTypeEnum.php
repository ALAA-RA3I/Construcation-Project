<?php declare(strict_types=1);

namespace App\Domain\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MediaTypeEnum extends Enum
{
    const Project = 'project';
    const Property = 'property';
}
