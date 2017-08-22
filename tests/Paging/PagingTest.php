<?php

namespace OneMustCode\Query\Tests\Paging;

use OneMustCode\Query\Paging\Paging;
use PHPUnit\Framework\TestCase;

class PagingTest extends TestCase
{
    public function testPaging()
    {
        $paging = new Paging();

        $this->assertEquals(1, $paging->getPage());
        $this->assertEquals(15, $paging->getPerPage());
    }

    public function testChangePage()
    {
        $paging = new Paging();

        $paging->setPage(5);

        $this->assertEquals(5, $paging->getPage());
        $this->assertEquals(15, $paging->getPerPage());
    }

    public function testChangePerPage()
    {
        $paging = new Paging();

        $paging->setPerPage(50);

        $this->assertEquals(1, $paging->getPage());
        $this->assertEquals(50, $paging->getPerPage());
    }
}