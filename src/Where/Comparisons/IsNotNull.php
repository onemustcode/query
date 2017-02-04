<?php

namespace OneMustCode\Query\Where\Comparisons;

class IsNotNull extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'nnull';
    }
}