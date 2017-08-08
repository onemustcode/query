<?php

namespace OneMustCode\Query\Builders;

use Doctrine\ORM\QueryBuilder as QueryBuilder;
use OneMustCode\Query\Builders\Filters;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineEqualsFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineGreaterThanFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineGreaterThanOrEqualsFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineInFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsLessThanFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsLessThanOrEqualsFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsNotNullFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsNullFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineLikeFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineNotEqualsFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineNotInFilterHandler;
use OneMustCode\Query\Builders\Filters\Expression\FilterHandler;
use OneMustCode\Query\Query;

class DoctrineQueryBuilder
{
    /** @var FilterHandler[] */
    protected $filterHandlers;

    /**
     * @param FilterHandler[] $additionalFilterHandlers
     */
    public function __construct(array $additionalFilterHandlers = [])
    {
        $defaultFilterHandlers = [
            new DoctrineEqualsFilterHandler(),
            new DoctrineGreaterThanFilterHandler(),
            new DoctrineGreaterThanOrEqualsFilterHandler(),
            new DoctrineInFilterHandler(),
            new DoctrineIsLessThanFilterHandler(),
            new DoctrineIsLessThanOrEqualsFilterHandler(),
            new DoctrineIsNotNullFilterHandler(),
            new DoctrineIsNullFilterHandler(),
            new DoctrineLikeFilterHandler(),
            new DoctrineNotEqualsFilterHandler(),
            new DoctrineNotInFilterHandler(),
        ];

        /** @var FilterHandler[] $filterHandlers */
        $filterHandlers = array_merge($defaultFilterHandlers, $additionalFilterHandlers);

        foreach ($filterHandlers as $filterHandler) {
            $this->filterHandlers[$filterHandler->handles()] = $filterHandler;
        }
    }

    /**
     * @param Query $query
     * @param QueryBuilder|null $queryBuilder
     * @param array $acceptedFilters
     * @param array $acceptedSortings
     * @return QueryBuilder
     */
    public function build(Query $query, QueryBuilder $queryBuilder = null, array $acceptedFilters, array $acceptedSortings)
    {
        foreach ($query->getFilters() as $filter) {
            $expr = null;

            if (! array_key_exists($filter->getField(), $acceptedFilters)) {
                continue;
            }

            if (! array_key_exists($filter->getOperator(), $this->filterHandlers)) {
                continue;
            }

            $this->filterHandlers[$filter->getOperator()]->addFilterToQueryBuilder($queryBuilder, $filter);
        }

        foreach ($query->getSortings() as $sorting) {
            $expr = null;

            if (! array_key_exists($sorting->getField(), $acceptedSortings)) {
                continue;
            }

            $field = $acceptedSortings[$sorting->getField()];

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