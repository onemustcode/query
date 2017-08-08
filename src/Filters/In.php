<?php

namespace OneMustCode\Query\Filters;

class In extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'in';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}