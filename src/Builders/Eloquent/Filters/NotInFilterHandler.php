<?php

namespace OneMustCode\Query\Builders\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\NotIn;

class NotInFilterHandler implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return NotIn::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(Builder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->whereNotIn($field, explode(',', $filter->getValue()));

        return $queryBuilder;
    }
}