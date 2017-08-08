<?php

namespace OneMustCode\Query\Filters;

class NotIn extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'nin';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}