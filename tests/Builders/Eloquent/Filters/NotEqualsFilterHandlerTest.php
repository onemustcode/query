<?php

use OneMustCode\Query\Builders\Eloquent\Filters\NotEqualsFilterHandler;
use OneMustCode\Query\Filters\NotEquals;

/**
 * @covers NotEqualsFilterHandler
 */
class NotEqualsFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new NotEqualsFilterHandler();
    }

    protected function getFilter()
    {
        return new NotEquals('foo', 'bar');
    }

    protected function getOperator()
    {
        return NotEquals::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Basic',
            'column' => $this->getFilter()->getField(),
            'operator' => '!=',
            'boolean' => 'and',
            'value' => $this->getFilter()->getValue(),
        ];
    }
}