<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\IsNull;

/**
 * @covers OneMustCode\Query\Filters\IsNull
 */
class IstNullFilterTest extends AbstractFilterTest
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
        return 'null';
    }

    protected function getFilter()
    {
        return new IsNull('field');
    }
}