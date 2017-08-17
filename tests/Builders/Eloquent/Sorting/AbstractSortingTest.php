<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;
use OneMustCode\Query\Sorting\SortingInterface;
use OneMustCode\Query\Builders\Eloquent\Sorting\SortingHandlerInterface;

abstract class AbstractSortingTest extends TestCase
{
    public function setUp()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => __DIR__.'/../database.sqlite',
            'prefix' => ''
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

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
        return SortingModel::query();
    }
}

class SortingModel extends \Illuminate\Database\Eloquent\Model
{
    //
}