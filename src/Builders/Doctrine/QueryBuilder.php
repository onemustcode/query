<?php

namespace OneMustCode\Query\Builders\Doctrine;

use Doctrine\ORM\QueryBuilder as DoctrineQueryBuilder;
use OneMustCode\Query\Builders\Doctrine\Filters\EqualsFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\GreaterThanFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\GreaterThanOrEqualsFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\InFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\LessThanFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\LessThanOrEqualsFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\IsNotNullFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\IsNullFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\LikeFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\NotEqualsFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\NotInFilterHandler;
use OneMustCode\Query\Builders\Doctrine\Filters\FilterHandlerInterface;
use OneMustCode\Query\Query;

class QueryBuilder
{
    /** @var FilterHandlerInterface[] */
    protected $filterHandlers;

    /**
     * @param FilterHandlerInterface[] $additionalFilterHandlers
     */
    public function __construct(array $additionalFilterHandlers = [])
    {
        $defaultFilterHandlers = [
            new EqualsFilterHandler(),
            new GreaterThanFilterHandler(),
            new GreaterThanOrEqualsFilterHandler(),
            new InFilterHandler(),
            new LessThanFilterHandler(),
            new LessThanOrEqualsFilterHandler(),
            new IsNotNullFilterHandler(),
            new IsNullFilterHandler(),
            new LikeFilterHandler(),
            new NotEqualsFilterHandler(),
            new NotInFilterHandler(),
        ];

        /** @var FilterHandlerInterface[] $filterHandlers */
        $filterHandlers = array_merge($defaultFilterHandlers, $additionalFilterHandlers);

        foreach ($filterHandlers as $filterHandler) {
            $this->filterHandlers[$filterHandler->handles()] = $filterHandler;
        }
    }

    /**
     * @param Query $query
     * @param DoctrineQueryBuilder|null $doctrineQueryBuilder
     * @param array $acceptedFilters
     * @param array $acceptedSortings
     * @return DoctrineQueryBuilder
     */
    public function build(Query $query, DoctrineQueryBuilder $doctrineQueryBuilder = null, array $acceptedFilters, array $acceptedSortings)
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

            $this->filterHandlers[$filter->getOperator()]->addFilterToQueryBuilder($doctrineQueryBuilder, $field, $filter);
        }

        foreach ($query->getSortings() as $sorting) {
            $expr = null;

            if (! array_key_exists($sorting->getField(), $acceptedSortings)) {
                continue;
            }

            $field = $acceptedSortings[$sorting->getField()];

            switch ($sorting->getDirection()) {
                case 'asc':
                    $expr = $doctrineQueryBuilder->expr()->asc($field);
                    break;
                case 'desc':
                    $expr = $doctrineQueryBuilder->expr()->desc($field);
                    break;
            }

            if ($expr) {
                $doctrineQueryBuilder->addOrderBy($expr);
            }
        }

        return $doctrineQueryBuilder;
    }
}