<?php

namespace OneMustCode\Query\Builders\Eloquent\Sorting;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Sorting\Descending;
use OneMustCode\Query\Sorting\SortingInterface;

class DescendingSortingHandler implements SortingHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return Descending::DIRECTION;
    }

    /**
     * @inheritdoc
     */
    public function addSortingToQueryBuilder(Builder $queryBuilder, $field, SortingInterface $sorting)
    {
        $queryBuilder->orderBy($field, 'DESC');

        return $queryBuilder;
    }
}