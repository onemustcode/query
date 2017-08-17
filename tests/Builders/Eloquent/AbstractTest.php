<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent;

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

abstract class AbstractTest extends TestCase
{
    public function setUp()
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => __DIR__.'/../database.sqlite',
            'prefix' => ''
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}