<?php

namespace OneMustCode\Query\Filters;

class LessThan extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'lt';
    }
}