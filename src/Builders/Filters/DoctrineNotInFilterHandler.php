<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\NotIn;

class DoctrineNotInFilterHandler implements FilterHandler
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return NotIn::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->notIn($field, explode(',', $filter->getValue()))
        );

        return $queryBuilder;
    }
}

