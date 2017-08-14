<?php

namespace OneMustCode\Query\Builders\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Filters\FilterInterface;

class EqualsFilterHandler implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return Equals::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(Builder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->where($field, '=', $filter->getValue());

        return $queryBuilder;
    }
}