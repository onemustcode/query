<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\GreaterThanOrEquals;

/**
 * @covers OneMustCode\Query\Filters\GreaterThanOrEquals
 */
class GreaterThanOrEqualsFilterTest extends AbstractFilterTest
{
    protected function getExpectedField()
    {
        return 'field';
    }

    protected function getExpectedValue()
    {
        return 10;
    }

    protected function getExpectedOperator()
    {
        return 'gte';
    }

    protected function getFilter()
    {
        return new GreaterThanOrEquals('field', 10);
    }
}