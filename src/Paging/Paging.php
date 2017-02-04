<?php

namespace OneMustCode\Query\Paging;

class Paging
{
    /** @var int */
    private $page;

    /** @var int */
    private $perPage;

    /**
     * @param int $page
     * @param int $perPage
     */
    public function __construct($page = 1, $perPage = 15)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }
}