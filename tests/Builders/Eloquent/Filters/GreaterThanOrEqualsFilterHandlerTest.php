<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\GreaterThanOrEqualsFilterHandler;
use OneMustCode\Query\Filters\GreaterThanOrEquals;

/**
 * @covers OneMustCode\Query\Builders\Eloquent\Filters\GreaterThanOrEqualsFilterHandler
 */
class GreaterThanOrEqualsFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new GreaterThanOrEqualsFilterHandler();
    }

    protected function getFilter()
    {
        return new GreaterThanOrEquals('foo', 10);
    }

    protected function getOperator()
    {
        return GreaterThanOrEquals::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Basic',
            'column' => $this->getFilter()->getField(),
            'operator' => '>=',
            'boolean' => 'and',
            'value' => $this->getFilter()->getValue(),
        ];
    }
}