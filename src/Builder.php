<?php

namespace OneMustCode\Query;

use OneMustCode\Query\Paging\Paging;
use OneMustCode\Query\Ordering\Ascending;
use OneMustCode\Query\Ordering\Descending;
use OneMustCode\Query\Where\Comparisons\Equals;
use OneMustCode\Query\Where\Comparisons\GreaterThan;
use OneMustCode\Query\Where\Comparisons\GreaterThanOrEquals;
use OneMustCode\Query\Where\Comparisons\In;
use OneMustCode\Query\Where\Comparisons\IsNotNull;
use OneMustCode\Query\Where\Comparisons\LessThan;
use OneMustCode\Query\Where\Comparisons\LessThanOrEquals;
use OneMustCode\Query\Where\Comparisons\NotEquals;
use OneMustCode\Query\Where\Comparisons\NotIn;
use OneMustCode\Query\Where\Where;

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
        '=' => Equals::class,
        '!=' => NotEquals::class,
        '>' => GreaterThan::class,
        '>=' => GreaterThanOrEquals::class,
        '<' => LessThan::class,
        '<=' => LessThanOrEquals::class,
        'in' => In::class,
        '!in' => NotIn::class,
        'null' => IsNotNull::class,
        '!null' => IsNotNull::class,
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
        $where = [];
        $ordering = [];
        $includes = [];

        if (isset($this->data['page'], $this->data['per_page'])) {
            $paging = new Paging($this->data['page'], $this->data['per_page']);
        }

        if (isset($this->data['where'])) {
            foreach ($this->data['where'] as $field => $data) {
                $comparison = key($data);
                $value = reset($data);
                if (array_key_exists($comparison, $this->whereComparisons)) {
                    $where[] = new Where($field, new $this->whereComparisons[]($value));
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
                    $ordering[] = new $this->orderingDirections($field);
                }
            }
        }

        return new Query($paging, $where, $ordering, $includes);
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