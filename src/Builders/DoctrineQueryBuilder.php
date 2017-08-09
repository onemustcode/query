<?php

namespace OneMustCode\Query\Builders;

use Doctrine\ORM\QueryBuilder as QueryBuilder;
use OneMustCode\Query\Builders\Filters;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineEqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineGreaterThanFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineGreaterThanOrEqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineInFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsLessThanFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsLessThanOrEqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsNotNullFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineIsNullFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineLikeFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineNotEqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\DoctrineNotInFilterHandlerInterface;
use OneMustCode\Query\Builders\Filters\Expression\FilterHandlerInterface;
use OneMustCode\Query\Query;

class DoctrineQueryBuilder
{
    /** @var FilterHandlerInterface[] */
    protected $filterHandlers;

    /**
     * @param FilterHandlerInterface[] $additionalFilterHandlers
     */
    public function __construct(array $additionalFilterHandlers = [])
    {
        $defaultFilterHandlers = [
            new DoctrineEqualsFilterHandlerInterface(),
            new DoctrineGreaterThanFilterHandlerInterface(),
            new DoctrineGreaterThanOrEqualsFilterHandlerInterface(),
            new DoctrineInFilterHandlerInterface(),
            new DoctrineIsLessThanFilterHandlerInterface(),
            new DoctrineIsLessThanOrEqualsFilterHandlerInterface(),
            new DoctrineIsNotNullFilterHandlerInterface(),
            new DoctrineIsNullFilterHandlerInterface(),
            new DoctrineLikeFilterHandlerInterface(),
            new DoctrineNotEqualsFilterHandlerInterface(),
            new DoctrineNotInFilterHandlerInterface(),
        ];

        /** @var FilterHandlerInterface[] $filterHandlers */
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

            $field = $acceptedFilters[$filter->getField()];

            $this->filterHandlers[$filter->getOperator()]->addFilterToQueryBuilder($queryBuilder, $field, $filter);
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