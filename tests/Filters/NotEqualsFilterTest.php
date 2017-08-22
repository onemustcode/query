<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\NotEquals;

/**
 * @covers OneMustCode\Query\Filters\NotEquals
 */
class NotEqualsFilterTest extends AbstractFilterTest
{
    protected function getExpectedField()
    {
        return 'field';
    }

    protected function getExpectedValue()
    {
        return 'value';
    }

    protected function getExpectedOperator()
    {
        return 'neq';
    }

    protected function getFilter()
    {
        return new NotEquals('field', 'value');
    }
}