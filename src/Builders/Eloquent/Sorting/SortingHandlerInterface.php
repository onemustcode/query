<?php

namespace OneMustCode\Query\Builders\Eloquent\Sorting;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Sorting\SortingInterface;

interface SortingHandlerInterface
{
    /**
     * @return string
     */
    public function handles();

    /**
     * @param Builder $queryBuilder
     * @param string $field
     * @param SortingInterface $sorting
     * @return Builder
     */
    public function addSortingToQueryBuilder(Builder $queryBuilder, $field, SortingInterface $sorting);
}