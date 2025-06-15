<?php declare(strict_types=1);

namespace App\Domain\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProjectRoleEnum extends Enum
{
    const ProjectManager = 'project_manager';
    const ExecutionEngineer = 'execution_engineer';
    const StudyEngineer = 'study_engineer';

}
