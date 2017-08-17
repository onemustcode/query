<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Sorting;

use OneMustCode\Query\Tests\Builders\Eloquent\AbstractTest;
use OneMustCode\Query\Sorting\SortingInterface;
use OneMustCode\Query\Builders\Eloquent\Sorting\SortingHandlerInterface;
use OneMustCode\Query\Tests\Builders\Eloquent\Model;

abstract class AbstractSortingTest extends AbstractTest
{
    /**
     * @return SortingHandlerInterface
     */
    abstract protected function getSortingHandler();

    /**
     * @return SortingInterface
     */
    abstract protected function getSorting();

    /**
     * @return string
     */
    abstract protected function getDirection();

    /**
     * @return array
     */
    abstract protected function getOrder();

    public function testThatHandlesMethodReturnsCorrectDirection()
    {
        $this->assertEquals(
            $this->getDirection(),
            $this->getSortingHandler()->handles()
        );
    }

    public function testThatSortingIsAddedToTheQuery()
    {
        $sorting = $this->getSorting();

        $handler = $this->getSortingHandler();

        $model = $handler->addSortingToQueryBuilder(
            $this->getModel(),
            $sorting->getField(),
            $sorting
        );

        $modelOrders = $model->getQuery()->orders;

        $this->assertEquals(
            $this->getDirection(),
            $handler->handles()
        );

        $this->assertCount(1, $modelOrders);

        $this->assertEquals(
            $this->getOrder(),
            $modelOrders[0]
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getModel()
    {
        return Model::query();
    }
}