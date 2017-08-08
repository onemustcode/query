<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\IsNotNull;

class DoctrineIsNotNullFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return IsNotNull::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->isNotNull($filter->getField())
        );

        return $queryBuilder;
    }
}

