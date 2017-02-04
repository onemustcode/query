<?php

namespace OneMustCode\Query\Where;

use OneMustCode\Query\Where\Comparisons\ComparisonInterface;

interface WhereInterface
{
    /**
     * @return string
     */
    public function getField();

    /**
     * @return ComparisonInterface
     */
    public function getComparison();
}