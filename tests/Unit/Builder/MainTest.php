<?php

namespace Test\Unit\Builder;

use Builder\Main as Builder;
use VO\NotEmptyString;

class MainTest extends \PHPUnit_Framework_TestCase
{
    public function testLevelOne()
    {
        $builder = new Builder(new NotEmptyString('LevelOne'));
        $builder->buildLevel();
        $beeSwarm = $builder->getBeeSwarm();
        // A few assertions to identify that it's exactly what we expect.
        static::assertSame(14, $beeSwarm->getCount());
        static::assertTrue($beeSwarm->isQueenAlive());
    }
}
