<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Filters\FilterInterface;

class DoctrineEqualsFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return Equals::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->eq($filter->getField(), $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}