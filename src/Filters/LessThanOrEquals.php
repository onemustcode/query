<?php

namespace OneMustCode\Query\Filters;

class LessThanOrEquals extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'lte';
    }
}