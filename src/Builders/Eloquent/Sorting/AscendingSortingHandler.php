<?php

namespace OneMustCode\Query\Builders\Eloquent\Sorting;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Sorting\Ascending;
use OneMustCode\Query\Sorting\SortingInterface;

class AscendingSortingHandler implements SortingHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return Ascending::DIRECTION;
    }

    /**
     * @inheritdoc
     */
    public function addSortingToQueryBuilder(Builder $queryBuilder, $field, SortingInterface $sorting)
    {
        $queryBuilder->orderBy($field, 'ASC');

        return $queryBuilder;
    }
}