<?php

namespace OneMustCode\Query\Filters;

abstract class AbstractFilter
{
    /** @var string */
    protected $field;

    /** @var string */
    protected $value;

    /**
     * @param string $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    abstract public function getOperator();
}