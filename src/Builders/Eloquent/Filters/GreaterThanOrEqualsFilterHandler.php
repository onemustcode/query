<?php

namespace OneMustCode\Query\Builders\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\GreaterThanOrEquals;

class GreaterThanOrEqualsFilterHandler implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return GreaterThanOrEquals::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(Builder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->where($field, '>=', $filter->getValue());

        return $queryBuilder;
    }
}