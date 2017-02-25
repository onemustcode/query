<?php

namespace OneMustCode\Query\Filters;

class NotIn extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'nin';
    }
}