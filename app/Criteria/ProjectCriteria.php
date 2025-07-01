<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProjectCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class ProjectCriteria implements CriteriaInterface
{
    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('project_id', $this->projectId);
    }
}
