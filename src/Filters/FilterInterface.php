<?php

namespace OneMustCode\Query\Filters;

interface FilterInterface
{
    /**
     * @return string
     */
    public function getField();

    /**
     * @return string
     */
    public function getOperator();

    /**
     * @return mixed
     */
    public function getValue();
}