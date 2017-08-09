<?php

namespace OneMustCode\Query\Builders\Doctrine;

use Doctrine\ORM\QueryBuilder as DoctrineQueryBuilder;
use OneMustCode\Query\Builders\Doctrine\Filters\EqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\GreaterThanFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\GreaterThanOrEqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\InFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\IsLessThanFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\IsLessThanOrEqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\IsNotNullFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\IsNullFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\LikeFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\NotEqualsFilterHandlerInterface;
use OneMustCode\Query\Builders\Doctrine\Filters\NotInFilterHandlerInterface;
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
            new EqualsFilterHandlerInterface(),
            new GreaterThanFilterHandlerInterface(),
            new GreaterThanOrEqualsFilterHandlerInterface(),
            new InFilterHandlerInterface(),
            new IsLessThanFilterHandlerInterface(),
            new IsLessThanOrEqualsFilterHandlerInterface(),
            new IsNotNullFilterHandlerInterface(),
            new IsNullFilterHandlerInterface(),
            new LikeFilterHandlerInterface(),
            new NotEqualsFilterHandlerInterface(),
            new NotInFilterHandlerInterface(),
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