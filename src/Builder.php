<?php

namespace OneMustCode\Query;

use OneMustCode\Query\Paging\Paging;
use OneMustCode\Query\Ordering\Ascending;
use OneMustCode\Query\Ordering\Descending;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Filters\GreaterThan;
use OneMustCode\Query\Filters\GreaterThanOrEquals;
use OneMustCode\Query\Filters\In;
use OneMustCode\Query\Filters\IsNotNull;
use OneMustCode\Query\Filters\LessThan;
use OneMustCode\Query\Filters\LessThanOrEquals;
use OneMustCode\Query\Filters\Like;
use OneMustCode\Query\Filters\NotEquals;
use OneMustCode\Query\Filters\NotIn;

class Builder
{
    /** @var array */
    protected $data;

    /** @var array */
    protected $orderingDirections = [
        'asc' => Ascending::class,
        'desc' => Descending::class,
    ];

    /** @var array */
    protected $whereComparisons = [
        'eq' => Equals::class,
        'neq' => NotEquals::class,
        'like' => Like::class,
        'gt' => GreaterThan::class,
        'gte' => GreaterThanOrEquals::class,
        'lt' => LessThan::class,
        'lte' => LessThanOrEquals::class,
        'in' => In::class,
        'nin' => NotIn::class,
        'null' => IsNotNull::class,
        'nnull' => IsNotNull::class,
    ];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Query
     */
    public function build()
    {
        $paging = null;
        $filters = [];
        $ordering = [];
        $includes = [];

        if (isset($this->data['page'], $this->data['per_page'])) {
            $paging = new Paging($this->data['page'], $this->data['per_page']);
        }

        if (isset($this->data['filters'])) {
            foreach ($this->data['filters'] as $field => $data) {
                $comparison = key($data);
                $value = reset($data);
                if (array_key_exists($comparison, $this->filters)) {
                    $filters[] = new $this->filters[$comparison]($field, $value);
                }
            }
        }

        if (isset($this->data['include'])) {
            foreach (explode(',', $this->data['include']) as $include) {
                if (! empty($include)) {
                    $includes[] = $include;
                }
            }
        }

        if (isset($this->data['order_by'])) {
            foreach ($this->data['order_by'] as $field => $direction) {
                if (array_key_exists($direction, $this->orderingDirections)) {
                    $ordering[] = new $this->orderingDirections[$direction]($field);
                }
            }
        }

        return new Query($paging, $filters, $ordering, $includes);
    }

    /**
     * @param array $data
     * @return Query
     */
    public static function createFromArray(array $data)
    {
        return (new self($data))->build();
    }
}