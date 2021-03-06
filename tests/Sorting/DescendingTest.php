<?php

namespace OneMustCode\Query\Tests\Sorting;

use OneMustCode\Query\Sorting\Descending;
use PHPUnit\Framework\TestCase;

/**
 * @covers OneMustCode\Query\Sorting\Descending
 */
class DescendingTest extends TestCase
{
    public function testSorting()
    {
        $descending = new Descending('field');

        $this->assertEquals('field', $descending->getField());
        $this->assertEquals('desc', $descending->getDirection());
    }
}