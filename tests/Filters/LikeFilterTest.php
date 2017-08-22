<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\Like;

/**
 * @covers OneMustCode\Query\Filters\Like
 */
class LikeFilterTest extends AbstractFilterTest
{
    protected function getExpectedField()
    {
        return 'field';
    }

    protected function getExpectedValue()
    {
        return '%value%';
    }

    protected function getExpectedOperator()
    {
        return 'like';
    }

    protected function getFilter()
    {
        return new Like('field', '%value%');
    }
}