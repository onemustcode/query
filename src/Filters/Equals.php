<?php

namespace OneMustCode\Query\Filters;

class Equals extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'eq';
    }
}