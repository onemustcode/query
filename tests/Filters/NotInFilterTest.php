<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\NotIn;

/**
 * @covers OneMustCode\Query\Filters\NotIn
 */
class NotInFilterTest extends AbstractFilterTest
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
        return 'nin';
    }

    protected function getFilter()
    {
        return new NotIn('field', '1,2,3,4');
    }
}