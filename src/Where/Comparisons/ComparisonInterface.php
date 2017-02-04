<?php

namespace OneMustCode\Query\Where\Comparisons;

interface ComparisonInterface
{
    /**
     * @return string
     */
    public function getOperator();

    /**
     * @return mixed
     */
    public function getValue();
}