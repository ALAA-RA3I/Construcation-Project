<?php

namespace App\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class AdvancedDynamicFilterSearchCriteria implements CriteriaInterface
{

    protected  $filters;
    protected  $search;
    protected  $searchColumns;

    /**
     * @param array $filters e.g. [['column' => 'employee.user.email', 'operator' => '=', 'value' => 'example@example.com']]
     * @param string|null $search
     * @param array $searchColumns e.g. ['employee.user.name', 'employee.user.email', 'reason']
     */
    public function __construct(array $filters = [],  $search = null, array $searchColumns = [])
    {
        $this->filters = $filters;
        $this->search = $search;
        $this->searchColumns = $searchColumns;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        /** @var Builder $query */
        $query = $model->newQuery(); // <-- this is the fix

        // Apply filters
        foreach ($this->filters as $filter) {
            $column = isset($filter['column']) ? $filter['column'] : null;
            $operator = isset($filter['operator']) ? $filter['operator'] : '=';
            $value = isset($filter['value']) ? $filter['value'] : null;

            if (!$column || !$operator) {
                continue;
            }

            $this->applyCondition($query, $column, $operator, $value);
        }

        // Apply search
        if ($this->search && !empty($this->searchColumns)) {
            $query->where(function ($q) {
                foreach ($this->searchColumns as $index => $column) {
                    $this->applySearchCondition($q, $column, $this->search, $index === 0);
                }
            });
        }

        return $query;
    }

    protected function applyCondition(Builder $query,  $column,  $operator, $value)
    {
        if (str_contains($column, '.')) {
            $this->applyRelationCondition($query, $column, $operator, $value);
        } else {
            if (strtolower($operator) === 'in' && is_array($value)) {
                $query->whereIn($column, $value);
            } else {
                $query->where($column, $operator, $value);
            }
        }
    }

    protected function applyRelationCondition(Builder $query,  $column,  $operator, $value)
    {
        $segments = explode('.', $column);
        $relation = implode('.', array_slice($segments, 0, -1));
        $field = end($segments);

        $query->whereHas($relation, function ($q) use ($field, $operator, $value) {
            if (strtolower($operator) === 'in' && is_array($value)) {
                $q->whereIn($field, $value);
            } else {
                $q->where($field, $operator, $value);
            }
        });
    }

    protected function applySearchCondition(Builder $query,  $column,  $search,  $isFirst)
    {
        if (str_contains($column, '.')) {
            $segments = explode('.', $column);
            $relation = implode('.', array_slice($segments, 0, -1));
            $field = end($segments);

            $queryMethod = $isFirst ? 'whereHas' : 'orWhereHas';

            $query->{$queryMethod}($relation, function ($q) use ($field, $search) {
                $q->where($field, 'like', '%' . $search . '%');
            });
        } else {
            $queryMethod = $isFirst ? 'where' : 'orWhere';
            $query->{$queryMethod}($column, 'like', '%' . $search . '%');
        }
    }

}
