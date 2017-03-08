<?php

namespace OneMustCode\Query\Builders;

use Doctrine\ORM\QueryBuilder as QueryBuilder;
use OneMustCode\Query\Query;

class DoctrineQueryBuilder
{
    /** @var array */
    protected $acceptedFilters = [];

    /** @var array */
    protected $acceptedSortings = [];

    /**
     * @param Query $query
     * @param QueryBuilder|null $queryBuilder
     * @return QueryBuilder
     */
    public function build(Query $query, QueryBuilder $queryBuilder = null)
    {
        foreach ($query->getFilters() as $filter) {
            $expr = null;

            if (! array_key_exists($filter->getField(), $this->acceptedFilters)) {
                continue;
            }

            $field = $this->acceptedFilters[$filter->getField()];

            switch ($filter->getOperator()) {
                case 'null':
                    $expr = $queryBuilder->expr()->isNull($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
                case 'nnull':
                    $expr = $queryBuilder->expr()->isNotNull($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
                case 'in':
                    $expr = $queryBuilder->expr()->in($field, $queryBuilder->expr()->literal(explode(',', $filter->getValue())));
                    break;
                case 'nin':
                    $expr = $queryBuilder->expr()->notIn($field, $queryBuilder->expr()->literal(explode(',', $filter->getValue())));
                    break;
                case 'gte':
                    $expr = $queryBuilder->expr()->gte($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
                case 'gt':
                    $expr = $queryBuilder->expr()->gt($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
                case 'lt':
                    $expr = $queryBuilder->expr()->lt($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
                case 'lte':
                    $expr = $queryBuilder->expr()->lte($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
                case 'eq':
                    $expr = $queryBuilder->expr()->eq($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
                case 'like':
                    $expr = $queryBuilder->expr()->like($field, $queryBuilder->expr()->literal($filter->getValue()));
                    break;
            }

            if ($expr) {
                $queryBuilder->andWhere($expr);
            }
        }

        foreach ($query->getSortings() as $sorting) {
            $expr = null;

            if (! array_key_exists($sorting->getField(), $this->acceptedSortings)) {
                continue;
            }

            $field = $this->acceptedSortings[$sorting->getField()];

            switch ($sorting->getDirection()) {
                case 'asc':
                    $expr = $queryBuilder->expr()->asc($field);
                    break;
                case 'desc':
                    $expr = $queryBuilder->expr()->desc($field);
                    break;
            }

            if ($expr) {
                $queryBuilder->addOrderBy($expr);
            }
        }

        return $queryBuilder;
    }
}