<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\GreaterThanFilterHandler;
use OneMustCode\Query\Filters\GreaterThan;

/**
 * @covers GreaterThanFilterHandler
 */
class GreaterThanFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new GreaterThanFilterHandler();
    }

    protected function getFilter()
    {
        return new GreaterThan('foo', 10);
    }

    protected function getOperator()
    {
        return GreaterThan::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Basic',
            'column' => $this->getFilter()->getField(),
            'operator' => '>',
            'boolean' => 'and',
            'value' => $this->getFilter()->getValue(),
        ];
    }
}