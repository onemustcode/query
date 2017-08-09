<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\GreaterThanOrEquals;

class DoctrineGreaterThanOrEqualsFilterHandlerInterface implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return GreaterThanOrEquals::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->gte($field, $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}

