<?php

namespace OneMustCode\Query\Tests\Sorting;

use OneMustCode\Query\Sorting\Ascending;
use PHPUnit\Framework\TestCase;

class AscendingTest extends TestCase
{
    public function testSorting()
    {
        $ascending = new Ascending('field');

        $this->assertEquals('field', $ascending->getField());
        $this->assertEquals('asc', $ascending->getDirection());
    }
}