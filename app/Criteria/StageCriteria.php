<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class StageCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class StageCriteria implements CriteriaInterface
{
    protected $stageId;

    public function __construct($stageId)
    {
        $this->stageId = $stageId;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('stage_id', $this->stageId);
    }
}
