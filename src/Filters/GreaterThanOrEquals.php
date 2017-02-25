<?php

namespace OneMustCode\Query\Filters;

class GreaterThanOrEquals extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'gte';
    }
}