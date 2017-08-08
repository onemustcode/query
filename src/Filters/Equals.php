<?php

namespace OneMustCode\Query\Filters;

class Equals extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'eq';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}