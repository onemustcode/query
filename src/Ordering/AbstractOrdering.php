<?php

namespace OneMustCode\Query\Ordering;

abstract class AbstractOrdering
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