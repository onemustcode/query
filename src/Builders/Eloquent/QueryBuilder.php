<?php

namespace OneMustCode\Query\Builders\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use OneMustCode\Query\Builders\Eloquent\Filters\EqualsFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\GreaterThanFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\GreaterThanOrEqualsFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\InFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\LessThanFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\LessThanOrEqualsFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\IsNotNullFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\IsNullFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\LikeFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\NotEqualsFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\NotInFilterHandler;
use OneMustCode\Query\Builders\Eloquent\Filters\FilterHandlerInterface;
use OneMustCode\Query\Query;

class QueryBuilder
{
    /** @var FilterHandlerInterface[] */
    protected $filterHandlers = [];

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
     * @param Builder|null $eloquentQueryBuilder
     * @param array $acceptedFilters
     * @param array $acceptedSortings
     * @return Builder
     */
    public function build(Query $query, Builder $eloquentQueryBuilder = null, array $acceptedFilters, array $acceptedSortings)
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

            $this->filterHandlers[$filter->getOperator()]->addFilterToQueryBuilder($eloquentQueryBuilder, $field, $filter);
        }

        foreach ($query->getSortings() as $sorting) {
            if (! array_key_exists($sorting->getField(), $acceptedSortings)) {
                continue;
            }

            $field = $acceptedSortings[$sorting->getField()];

            switch ($sorting->getDirection()) {
                case 'asc':
                    $eloquentQueryBuilder->orderBy($field, 'ASC');
                    break;
                case 'desc':
                    $eloquentQueryBuilder->orderBy($field, 'DESC');
                    break;
            }
        }

        return $eloquentQueryBuilder;
    }
}