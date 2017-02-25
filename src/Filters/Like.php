<?php

namespace OneMustCode\Query\Filters;

class Like extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'like';
    }
}