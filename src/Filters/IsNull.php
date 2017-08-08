<?php

namespace OneMustCode\Query\Filters;

class IsNull extends AbstractFilter implements FilterInterface
{
    const OPERATOR = 'null';

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