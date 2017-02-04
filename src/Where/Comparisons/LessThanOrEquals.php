<?php

namespace OneMustCode\Query\Where\Comparisons;

class LessThanOrEquals extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return '<=';
    }
}