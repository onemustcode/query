<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\In;

class DoctrineInFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return In::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->in($filter->getField(), explode(',', $filter->getValue()))
        );

        return $queryBuilder;
    }
}

