<?php

namespace OneMustCode\Query\Where\Comparisons;

class GreaterThan extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return '>';
    }
}