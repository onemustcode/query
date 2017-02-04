<?php

namespace OneMustCode\Query\Where\Comparisons;

class Equals extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'eq';
    }
}