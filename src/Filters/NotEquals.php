<?php

namespace OneMustCode\Query\Filters;

class NotEquals extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'neq';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}