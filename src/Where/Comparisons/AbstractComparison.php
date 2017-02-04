<?php

namespace OneMustCode\Query\Where\Comparisons;

abstract class AbstractComparison
{
    /** @var string */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
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