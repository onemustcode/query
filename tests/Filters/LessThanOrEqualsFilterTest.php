<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\LessThanOrEquals;

/**
 * @covers OneMustCode\Query\Filters\LessThanOrEquals
 */
class LessThanOrEqualsFilterTest extends AbstractFilterTest
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
        return 'lte';
    }

    protected function getFilter()
    {
        return new LessThanOrEquals('field', 10);
    }
}