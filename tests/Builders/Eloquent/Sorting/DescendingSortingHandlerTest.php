<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Sorting;

use OneMustCode\Query\Builders\Eloquent\Sorting\DescendingSortingHandler;
use OneMustCode\Query\Sorting\Descending;

/**
 * @covers DescendingSortingHandler
 */
class DescendingSortingHandlerTest extends AbstractSortingTest
{
    protected function getSortingHandler()
    {
        return new DescendingSortingHandler();
    }

    protected function getSorting()
    {
        return new Descending('foo');
    }

    protected function getDirection()
    {
        return Descending::DIRECTION;
    }

    protected function getOrder()
    {
        return [
            'column' => $this->getSorting()->getField(),
            'direction' => 'desc'
        ];
    }
}