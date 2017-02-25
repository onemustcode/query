<?php

namespace OneMustCode\Query\Sorting;

abstract class AbstractSorting
{
    /** @var string */
    private $field;

    /**
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string
     */
    abstract public function getDirection();
}