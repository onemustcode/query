<?php

namespace OneMustCode\Query;

use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Sorting\SortingInterface;
use OneMustCode\Query\Paging\Paging;

class Query
{
    /** @var null|Paging */
    protected $paging;

    /** @var array|FilterInterface[] */
    protected $filters = [];

    /** @var array|SortingInterface[] */
    protected $sortings = [];

    /** @var array */
    protected $includes = [];

    /**
     * @param Paging|null $paging
     * @param array $filters
     * @param array $sortings
     * @param array $includes
     */
    public function __construct(Paging $paging = null, array $filters = [], array $sortings = [], array $includes = [])
    {
        $this->paging = $paging;

        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }

        foreach ($sortings as $sorting) {
            $this->addSorting($sorting);
        }

        foreach ($includes as $item) {
            $this->addInclude($item);
        }
    }

    /**
     * @param Paging $paging
     * @return Query
     */
    public static function createFromPaging(Paging $paging)
    {
        return new self($paging);
    }

    /**
     * @param array $includes
     * @return Query
     */
    public static function createFromIncludes(array $includes)
    {
        return new self(null, [], [], $includes);
    }

    /**
     * @param array $sortings
     * @return Query
     */
    public static function createFromSortings(array $sortings)
    {
        return new self(null, [], $sortings, []);
    }

    /**
     * @param array $filters
     * @return Query
     */
    public static function createFromFilters(array $filters)
    {
        return new self(null, $filters);
    }

    /**
     * @return null|Paging
     */
    public function getPaging()
    {
        return $this->paging;
    }

    /**
     * @param null|Paging $paging
     */
    public function setPaging($paging)
    {
        $this->paging = $paging;
    }

    /**
     * @return array|FilterInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        if (! in_array($filter, $this->filters, true)) {
            $this->filters[] = $filter;
        }
    }

    /**
     * @param string $field
     * @return array|FilterInterface[]
     */
    public function getFiltersByField($field)
    {
        return array_filter($this->filters, function (FilterInterface $filter) use ($field) {
            return $filter->getField() === $field;
        });
    }

    /**
     * @return array|SortingInterface[]
     */
    public function getSortings()
    {
        return $this->sortings;
    }

    /**
     * @param SortingInterface $sorting
     */
    public function addSorting(SortingInterface $sorting)
    {
        if (! in_array($sorting, $this->sortings, true)) {
            $this->sortings[] = $sorting;
        }
    }

    /**
     * @param string $field
     * @return array|FilterInterface[]
     */
    public function getSortingsByField($field)
    {
        return array_filter($this->sortings, function (SortingInterface $sorting) use ($field) {
            return $sorting->getField() === $field;
        });
    }

    /**
     * @return array
     */
    public function getIncludes()
    {
        return $this->includes;
    }

    /**
     * @param string $include
     */
    public function addInclude($include)
    {
        if (! in_array($include, $this->includes)) {
            $this->includes[] = $include;
        }
    }
}