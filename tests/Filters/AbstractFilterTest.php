<?php

namespace OneMustCode\Query\Tests\Filters;

use OneMustCode\Query\Filters\FilterInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractFilterTest extends TestCase
{
    /**
     * @return string
     */
    abstract protected function getExpectedField();

    /**
     * @return string
     */
    abstract protected function getExpectedValue();

    /**
     * @return string
     */
    abstract protected function getExpectedOperator();

    /**
     * @return FilterInterface
     */
    abstract protected function getFilter();

    public function testFilter()
    {
        $filter = $this->getFilter();

        $this->assertEquals(
            $this->getExpectedField(),
            $filter->getField()
        );

        $this->assertEquals(
            $this->getExpectedValue(),
            $filter->getValue()
        );

        $this->assertEquals(
            $this->getExpectedOperator(),
            $filter->getOperator()
        );
    }
}