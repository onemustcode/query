<?php

namespace OneMustCode\Query;

use OneMustCode\Query\Ordering\OrderingInterface;
use OneMustCode\Query\Paging\Paging;
use OneMustCode\Query\Where\WhereInterface;

class Query
{
    /** @var null|Paging */
    protected $paging;

    /** @var WhereInterface[] */
    protected $where = [];

    /** @var OrderingInterface[] */
    protected $ordering = [];

    /** @var array */
    protected $includes = [];

    /**
     * @param Paging|null $paging
     * @param array $where
     * @param array $ordering
     * @param array $includes
     */
    public function __construct(Paging $paging = null, array $where = [], array $ordering = [], array $includes = [])
    {
        if ($paging === null) {
            $paging = new Paging();
        }

        $this->paging = $paging;

        foreach ($where as $item) {
            $this->addWhere($item);
        }

        foreach ($ordering as $item) {
            $this->addOrdering($item);
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
     * @param array $ordering
     * @return Query
     */
    public static function createFromOrdering(array $ordering)
    {
        return new self(null, [], $ordering, []);
    }

    /**
     * @param array $where
     * @return Query
     */
    public static function createFromWhere(array $where)
    {
        return new self(null, $where);
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
     * @return WhereInterface[]
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param WhereInterface $where
     */
    public function addWhere(WhereInterface $where)
    {
        if (! in_array($where, $this->where, true)) {
            $this->where[] = $where;
        }
    }

    /**
     * @return OrderingInterface[]
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @param OrderingInterface $ordering
     */
    public function addOrdering(OrderingInterface $ordering)
    {
        if (! in_array($ordering, $this->ordering, true)) {
            $this->ordering[] = $ordering;
        }
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