<?php

namespace OneMustCode\Query\Builders\Eloquent\Filters;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Filters\FilterInterface;

interface FilterHandlerInterface
{
    /**
     * @return string
     */
    public function handles();

    /**
     * @param Builder $queryBuilder
     * @param string $field
     * @param FilterInterface $filter
     * @return Builder
     */
    public function addFilterToQueryBuilder(Builder $queryBuilder, $field, FilterInterface $filter);
}