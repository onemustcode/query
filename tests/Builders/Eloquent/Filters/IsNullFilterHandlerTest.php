<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\IsNullFilterHandler;
use OneMustCode\Query\Filters\IsNull;

/**
 * @covers IsNullFilterHandler
 */
class IsNullFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new IsNullFilterHandler();
    }

    protected function getFilter()
    {
        return new IsNull('foo');
    }

    protected function getOperator()
    {
        return IsNull::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Null',
            'column' => $this->getFilter()->getField(),
            'boolean' => 'and',
        ];
    }
}