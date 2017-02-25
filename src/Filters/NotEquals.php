<?php

namespace OneMustCode\Query\Filters;

class NotEquals extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'neq';
    }
}