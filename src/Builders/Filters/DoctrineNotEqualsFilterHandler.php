<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\NotEquals;

class DoctrineNotEqualsFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return NotEquals::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->neq($filter->getField(), $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}

