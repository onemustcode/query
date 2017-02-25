<?php

namespace OneMustCode\Query\Filters;

class GreaterThan extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'gt';
    }
}