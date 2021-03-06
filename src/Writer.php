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

        if ($filters = $this->query->getFilters()) {
            $data['filters'] = [];
            foreach ($filters as $filter) {
                $data['filters'][$filter->getField()] = [
                    $filter->getOperator() => $filter->getValue(),
                ];
            }
        }

        if ($sortings = $this->query->getSortings()) {
            $data['sortings'] = [];
            foreach ($sortings as $sorting) {
                $data['sortings'][$sorting->getField()] = $sorting->getDirection();
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