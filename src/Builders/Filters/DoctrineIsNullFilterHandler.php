<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\IsNull;

class DoctrineIsNullFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return IsNull::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->isNull($filter->getField())
        );

        return $queryBuilder;
    }
}

