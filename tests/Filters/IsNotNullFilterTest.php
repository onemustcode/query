<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\IsNotNull;

/**
 * @covers OneMustCode\Query\Filters\IsNotNull
 */
class IsNotNullFilterTest extends AbstractFilterTest
{
    protected function getExpectedField()
    {
        return 'field';
    }

    protected function getExpectedValue()
    {
        return 1;
    }

    protected function getExpectedOperator()
    {
        return 'nnull';
    }

    protected function getFilter()
    {
        return new IsNotNull('field');
    }
}