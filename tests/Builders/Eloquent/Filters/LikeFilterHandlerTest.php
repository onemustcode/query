<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Builders\Eloquent\Filters\LikeFilterHandler;
use OneMustCode\Query\Filters\Like;

/**
 * @covers LikeFilterHandler
 */
class LikeFilterHandlerTest extends AbstractFilterTest
{
    protected function getFilterHandler()
    {
        return new LikeFilterHandler();
    }

    protected function getFilter()
    {
        return new Like('foo', '%john%');
    }

    protected function getOperator()
    {
        return Like::OPERATOR;
    }

    protected function getWhere()
    {
        return [
            'type' => 'Basic',
            'column' => $this->getFilter()->getField(),
            'boolean' => 'and',
            'value' => $this->getFilter()->getValue(),
            'operator' => 'LIKE',
        ];
    }
}