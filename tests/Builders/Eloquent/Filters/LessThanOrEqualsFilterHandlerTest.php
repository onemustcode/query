<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\LessThanOrEqualsFilterHandler;
use OneMustCode\Query\Filters\LessThanOrEquals;

/**
 * @covers OneMustCode\Query\Builders\Eloquent\Filters\LessThanOrEqualsFilterHandler
 */
class LessThanOrEqualsFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new LessThanOrEqualsFilterHandler();
    }

    protected function getFilter()
    {
        return new LessThanOrEquals('foo', 10);
    }

    protected function getOperator()
    {
        return LessThanOrEquals::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Basic',
            'column' => $this->getFilter()->getField(),
            'operator' => '<=',
            'boolean' => 'and',
            'value' => $this->getFilter()->getValue(),
        ];
    }
}