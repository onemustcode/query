<?php

namespace OneMustCode\Query\Filters;

class LessThan extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'lt';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}