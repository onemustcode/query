<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\GreaterThan;

class DoctrineGreaterThanFilterHandlerInterface implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return GreaterThan::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->gt($field, $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}
