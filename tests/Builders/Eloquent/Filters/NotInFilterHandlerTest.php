<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\NotInFilterHandler;
use OneMustCode\Query\Filters\NotIn;

/**
 * @covers OneMustCode\Query\Builders\Eloquent\Filters\NotInFilterHandler
 */
class NotInFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new NotInFilterHandler();
    }

    protected function getFilter()
    {
        return new NotIn('foo', '1,2,3,4');
    }

    protected function getOperator()
    {
        return NotIn::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'NotIn',
            'column' => $this->getFilter()->getField(),
            'boolean' => 'and',
            'values' => explode(',', $this->getFilter()->getValue()),
        ];
    }
}