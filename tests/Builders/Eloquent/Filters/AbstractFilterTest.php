<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent\Filters;

use OneMustCode\Query\Tests\Builders\Eloquent\AbstractTest;
use OneMustCode\Query\Filters\FilterInterface;
use OneMustCode\Query\Builders\Eloquent\Filters\FilterHandlerInterface;
use OneMustCode\Query\Tests\Builders\Eloquent\Model;

abstract class AbstractFilterTest extends AbstractTest
{
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
        return Model::query();
    }
}