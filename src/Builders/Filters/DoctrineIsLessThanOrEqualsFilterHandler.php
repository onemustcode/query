<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\LessThanOrEquals;

class DoctrineIsLessThanOrEqualsFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return LessThanOrEquals::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->lte($filter->getField(), $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}

