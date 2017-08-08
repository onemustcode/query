<?php

namespace OneMustCode\Query\Filters;

class GreaterThanOrEquals extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'gte';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}