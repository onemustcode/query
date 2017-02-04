<?php

namespace OneMustCode\Query\Where\Comparisons;

class In extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'in';
    }
}