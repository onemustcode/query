<?php

namespace OneMustCode\Query;

use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Filters\GreaterThan;
use OneMustCode\Query\Filters\GreaterThanOrEquals;
use OneMustCode\Query\Filters\In;
use OneMustCode\Query\Filters\IsNotNull;
use OneMustCode\Query\Filters\IsNull;
use OneMustCode\Query\Filters\LessThan;
use OneMustCode\Query\Filters\LessThanOrEquals;
use OneMustCode\Query\Filters\Like;
use OneMustCode\Query\Filters\NotEquals;
use OneMustCode\Query\Filters\NotIn;
use OneMustCode\Query\Paging\Paging;
use OneMustCode\Query\Sorting\Ascending;
use OneMustCode\Query\Sorting\Descending;

class Transformer
{
    /** @var array */
    protected $orderingDirections = [
        'asc' => Ascending::class,
        'desc' => Descending::class,
    ];

    /** @var array */
    protected $filters;

    /**
     * @param array $additionalFilters
     */
    public function __construct(array $additionalFilters = [])
    {
        $defaultFilters = [
            'eq' => Equals::class,
            'neq' => NotEquals::class,
            'like' => Like::class,
            'gt' => GreaterThan::class,
            'gte' => GreaterThanOrEquals::class,
            'lt' => LessThan::class,
            'lte' => LessThanOrEquals::class,
            'in' => In::class,
            'nin' => NotIn::class,
            'null' => IsNull::class,
            'nnull' => IsNotNull::class,
        ];

        $this->filters = array_merge($defaultFilters, $additionalFilters);
    }

    /**
     * @param array $data
     * @return Query
     */
    public function transform(array $data = [])
    {
        $paging = null;
        $filters = [];
        $ordering = [];
        $includes = [];

        $paging = new Paging(
            isset($data['page']) ? $data['page'] : 1,
            isset($data['per_page']) ? $data['per_page'] : 15
        );

        if (isset($data['filters'])) {
            foreach ($data['filters'] as $field => $data) {
                foreach($data as $operator => $value) {
                    if (array_key_exists($operator, $this->filters)) {
                        $filters[] = new $this->filters[$operator]($field, $value);
                    }
                }
            }
        }

        if (isset($data['include'])) {
            foreach (explode(',', $data['include']) as $include) {
                if (! empty($include)) {
                    $includes[] = $include;
                }
            }
        }

        if (isset($data['order_by'])) {
            foreach ($data['order_by'] as $field => $direction) {
                if (array_key_exists($direction, $this->orderingDirections)) {
                    $ordering[] = new $this->orderingDirections[$direction]($field);
                }
            }
        }

        return new Query($paging, $filters, $ordering, $includes);
    }
}
