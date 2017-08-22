<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\In;

/**
 * @covers OneMustCode\Query\Filters\In
 */
class InFilterTest extends AbstractFilterTest
{
    protected function getExpectedField()
    {
        return 'field';
    }

    protected function getExpectedValue()
    {
        return '1,2,3,4';
    }

    protected function getExpectedOperator()
    {
        return 'in';
    }

    protected function getFilter()
    {
        return new In('field', '1,2,3,4');
    }
}