<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\EqualsFilterHandler;
use OneMustCode\Query\Filters\Equals;

/**
 * @covers EqualsFilterHandler
 */
class EqualsFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new EqualsFilterHandler();
    }

    protected function getFilter()
    {
        return new Equals('foo', 'bar');
    }

    protected function getOperator()
    {
        return Equals::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Basic',
            'column' => $this->getFilter()->getField(),
            'operator' => '=',
            'boolean' => 'and',
            'value' => $this->getFilter()->getValue(),
        ];
    }
}