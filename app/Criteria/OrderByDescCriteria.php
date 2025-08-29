<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OrderByDescCriteria implements CriteriaInterface
{
    protected $column;

    public function __construct($column = 'id')
    {
        $this->column = $column;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->orderBy($this->column, 'desc');
    }
}
