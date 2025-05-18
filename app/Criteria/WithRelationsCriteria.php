<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class WithRelationsCriteria.
 *
 * @package namespace App\Criteria;
 */
class WithRelationsCriteria implements CriteriaInterface
{
    protected $relations;

    /**
     * @param array|string $relations
     */
    public function __construct($relations)
    {
        $this->relations = is_array($relations) ? $relations : [$relations];
    }

    /**
     * Apply criteria to query.
     *
     * @param Builder $model
     * @param RepositoryInterface $repository
     * @return Builder
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->with($this->relations);
    }
}
