<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\Equals;

/**
 * @covers OneMustCode\Query\Filters\Equals
 */
class EqualsFilterTest extends AbstractFilterTest
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
        return 'eq';
    }

    protected function getFilter()
    {
        return new Equals('field', 'value');
    }
}