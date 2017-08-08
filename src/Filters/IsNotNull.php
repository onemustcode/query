<?php

namespace OneMustCode\Query\Filters;

class IsNotNull extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'nnull';

    /**
     * @param string $field
     */
    public function __construct($field)
    {
        parent::__construct($field, '1');
    }

    /**
     * @inheritdoc
     */
    public function getOperator()
    {
        return self::OPERATOR;
    }
}