<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\LessThan;

class DoctrineIsLessThanFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return LessThan::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->lt($filter->getField(), $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}

