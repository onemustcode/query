<?php

use OneMustCode\Query\Builders\Eloquent\Filters\LessThanFilterHandler;
use OneMustCode\Query\Filters\LessThan;

/**
 * @covers LessThanFilterHandler
 */
class LessThanFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new LessThanFilterHandler();
    }

    protected function getFilter()
    {
        return new LessThan('foo', 10);
    }

    protected function getOperator()
    {
        return LessThan::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Basic',
            'column' => $this->getFilter()->getField(),
            'operator' => '<',
            'boolean' => 'and',
            'value' => $this->getFilter()->getValue(),
        ];
    }
}