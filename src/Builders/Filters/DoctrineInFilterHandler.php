<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\In;

class DoctrineInFilterHandler implements FilterHandler
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return In::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->in($field, explode(',', $filter->getValue()))
        );

        return $queryBuilder;
    }
}

