<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProjectCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class PropertyBookCriteria implements CriteriaInterface
{
    protected $property_book_id;

    public function __construct($property_book_id)
    {
        $this->property_book_id = $property_book_id;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('property_book_id', $this->property_book_id);
    }
}
