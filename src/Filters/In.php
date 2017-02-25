<?php

namespace OneMustCode\Query\Filters;

class In extends AbstractFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return 'in';
    }
}