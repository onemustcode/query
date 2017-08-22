<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\GreaterThan;

/**
 * @covers OneMustCode\Query\Filters\GreaterThan
 */
class GreaterThanFilterTest extends AbstractFilterTest
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
        return 'gt';
    }

    protected function getFilter()
    {
        return new GreaterThan('field', 10);
    }
}