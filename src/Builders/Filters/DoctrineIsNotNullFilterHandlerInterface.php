<?php

namespace OneMustCode\Query\Builders\Filters\Expression;

use Doctrine\ORM\QueryBuilder;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Filters\IsNotNull;

class DoctrineIsNotNullFilterHandlerInterface implements FilterHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handles()
    {
        return IsNotNull::OPERATOR;
    }

    /**
     * @inheritdoc
     */
    public function addFilterToQueryBuilder(QueryBuilder $queryBuilder, $field, FilterInterface $filter)
    {
        $queryBuilder->andWhere(
            $queryBuilder->expr()->isNotNull($field)
        );

        return $queryBuilder;
    }
}

