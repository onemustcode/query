<?php

namespace OneMustCode\Query;

class Writer
{
    /** @var Query */
    protected $query;

    /**
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        if ($paging = $this->query->getPaging()) {
            $data['paging'] = [
                'page' => $paging->getPage(),
                'per_page' => $paging->getPerPage(),
            ];
        }

        if ($wheres = $this->query->getWhere()) {
            $data['where'] = [];
            foreach ($wheres as $where) {
                $data['where'][$where->getField()] = [
                    $where->getComparison()->getOperator() => $where->getComparison()->getValue()
                ];
            }
        }

        if ($ordering = $this->query->getOrdering()) {
            $data['order_by'] = [];
            foreach ($ordering as $order) {
                $data['order_by'][$order->getField()] = $order->getDirection();
            }
        }

        if ($includes = $this->query->getIncludes()) {
            $data['include'] = implode(',', $includes);
        }

        return $data;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function toQueryParameters()
    {
        return http_build_query($this->toArray());
    }
}