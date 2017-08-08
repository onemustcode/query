<?php

namespace OneMustCode\Query\Filters;

class LessThanOrEquals extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'lte';

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}