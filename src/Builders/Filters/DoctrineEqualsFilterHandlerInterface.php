<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Filters\FilterInterface;

class DoctrineEqualsFilterHandlerInterface implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return Equals::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->eq($field, $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}