<?php

namespace OneMustCode\Query\Where\Comparisons;

class NotEquals extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'neq';
    }
}