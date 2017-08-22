<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\InFilterHandler;
use OneMustCode\Query\Filters\In;

/**
 * @covers OneMustCode\Query\Builders\Eloquent\Filters\InFilterHandler
 */
class InFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new InFilterHandler();
    }

    protected function getFilter()
    {
        return new In('foo', '1,2,3,4');
    }

    protected function getOperator()
    {
        return In::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'In',
            'column' => $this->getFilter()->getField(),
            'boolean' => 'and',
            'values' => explode(',', $this->getFilter()->getValue()),
        ];
    }
}