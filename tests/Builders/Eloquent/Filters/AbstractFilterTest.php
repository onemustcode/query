<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Builders\Eloquent\Filters\FilterHandlerInterface;

abstract class AbstractFilterTest extends TestCase
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
     * @return FilterHandlerInterface
     */
    abstract protected function getFilterHandler();

    /**
     * @return FilterInterface
     */
    abstract protected function getFilter();

    /**
     * @return string
     */
    abstract protected function getOperator();

    /**
     * @return array
     */
    abstract protected function getWhere();

    public function testThatHandlesMethodReturnsCorrectOperator()
    {
        $this->assertEquals(
            $this->getOperator(),
            $this->getFilterHandler()->handles()
        );
    }

    public function testThatFilterIsAddedToTheQuery()
    {
        $filter = $this->getFilter();

        $handler = $this->getFilterHandler();

        $model = $handler->addFilterToQueryBuilder(
            $this->getModel(),
            $filter->getField(),
            $filter
        );

        $modelWheres = $model->getQuery()->wheres;

        $this->assertEquals(
            $this->getOperator(),
            $handler->handles()
        );

        $this->assertCount(1, $modelWheres);

        $this->assertEquals(
            $this->getWhere(),
            $modelWheres[0]
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getModel()
    {
        return WhereModel::query();
    }
}

class WhereModel extends \Illuminate\Database\Eloquent\Model
{
    //
}