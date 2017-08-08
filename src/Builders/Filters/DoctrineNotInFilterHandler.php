<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\NotIn;

class DoctrineNotInFilterHandler implements FilterHandler
{
    /**
     * @return string
     */
    public function handles()
    {
        return NotIn::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param FilterInterface $filter
     * @return QueryBuilder
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->notIn($filter->getField(), explode(',', $filter->getValue()))
        );

        return $queryBuilder;
    }
}

