<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\LessThan;

/**
 * @covers OneMustCode\Query\Filters\LessThan
 */
class LessThanFilterTest extends AbstractFilterTest
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
        return 'lt';
    }

    protected function getFilter()
    {
        return new LessThan('field', 10);
    }
}