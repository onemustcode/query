<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\LessThanOrEquals;

class DoctrineIsLessThanOrEqualsFilterHandlerInterface implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return LessThanOrEquals::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->lte($field, $queryBuilder->expr()->literal($filter->getValue()))
        );

        return $queryBuilder;
    }
}

