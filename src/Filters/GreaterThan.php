<?php

namespace OneMustCode\Query\Filters;

class GreaterThan extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'gt';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}