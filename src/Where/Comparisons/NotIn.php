<?php

namespace OneMustCode\Query\Where\Comparisons;

class NotIn extends AbstractComparison implements ComparisonInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return '!in';
    }
}