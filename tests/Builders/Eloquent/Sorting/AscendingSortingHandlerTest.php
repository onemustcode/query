<?php

use OneMustCode\Query\Builders\Eloquent\Sorting\AscendingSortingHandler;
use OneMustCode\Query\Sorting\Ascending;

/**
 * @covers AscendingSortingHandler
 */
class AscendingSortingHandlerTest extends AbstractSortingTest
{
    protected function getSortingHandler()
    {
        return new AscendingSortingHandler();
    }

    protected function getSorting()
    {
        return new Ascending('foo');
    }

    protected function getDirection()
    {
        return Ascending::DIRECTION;
    }

    protected function getOrder()
    {
        return [
            'column' => $this->getSorting()->getField(),
            'direction' => 'asc'
        ];
    }
}