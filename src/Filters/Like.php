<?php

namespace OneMustCode\Query\Filters;

class Like extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'like';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}