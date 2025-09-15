<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WhereCriteria implements CriteriaInterface
{
    protected $field;
    protected $value;

    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where($this->field, $this->value);
    }
}
