<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class StageCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class SortByStartDateCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->orderBy('start_date', 'asc'); 
    }
}
