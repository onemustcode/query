<?php

namespace OneMustCode\Query\Where\Comparisons;

class IsNull extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'null';
    }
}