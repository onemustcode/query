<?php

namespace OneMustCode\Query\Where\Comparisons;

class GreaterThanOrEquals extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return '>=';
    }
}