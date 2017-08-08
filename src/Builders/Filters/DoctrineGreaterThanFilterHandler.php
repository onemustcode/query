<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\GreaterThan;

class DoctrineGreaterThanFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return GreaterThan::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->gt($filter->getField(), $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}
