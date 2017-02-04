<?php

namespace OneMustCode\Query\Where\Comparisons;

class LessThan extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'lt';
    }
}