<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;

interface FilterHandlerInterface
{
    /**
     * @return string
     */
    public function handles();

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $field
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter);
}