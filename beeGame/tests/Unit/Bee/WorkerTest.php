<?php

namespace Test\Unit\Bee;

use Bee\Worker;
use VO\PositiveInteger;

class WorkerTest extends \PHPUnit_Framework_TestCase
{
    public function testisQueen()
    {
        $bee = new Worker(new PositiveInteger(50), new PositiveInteger(12));
        static::assertFalse($bee->isQueen());
    }
}
