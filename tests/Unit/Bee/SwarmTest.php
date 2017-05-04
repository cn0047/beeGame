<?php

namespace Test\Unit\Bee;

use Bee\Bee;
use Bee\Drone;
use Bee\Swarm;
use Bee\Queen;
use Bee\Worker;
use VO\PositiveInteger;

class SwarmTest extends \PHPUnit_Framework_TestCase
{
    /** @var Swarm */
    private $beeSwarm;

    protected function setUp()
    {
        $this->beeSwarm = new Swarm();
    }

    public function testGetCount()
    {
        static::assertSame(0, $this->beeSwarm->getCount());
    }

    public function testAdd()
    {
        $this->beeSwarm->add(new Worker(new PositiveInteger(75), new PositiveInteger(10)));
        static::assertSame(1, $this->beeSwarm->getCount());
    }

    public function testShuffle()
    {
        $this->beeSwarm->add(new Queen(new PositiveInteger(100), new PositiveInteger(8)));
        $this->beeSwarm->add(new Worker(new PositiveInteger(75), new PositiveInteger(10)));
        $this->beeSwarm->add(new Drone(new PositiveInteger(50), new PositiveInteger(12)));
        $before = clone $this->beeSwarm;
        $this->beeSwarm->shuffle();
        $after = clone $this->beeSwarm;
        static::assertNotSame($before, $after);
    }

    public function testisQueenAlive()
    {
        $this->beeSwarm->add(new Queen(new PositiveInteger(100), new PositiveInteger(8)));
        static::assertTrue($this->beeSwarm->isQueenAlive());
    }

    public function testRandomHit()
    {
        $this->beeSwarm->add(new Worker(new PositiveInteger(75), new PositiveInteger(10)));
        $this->beeSwarm->randomHit();
        // One available way to break encapsulation.
        $reflection = new \ReflectionObject($this->beeSwarm);
        $property = $reflection->getProperty('bees');
        $property->setAccessible(true);
        /** @var Bee $bee */
        $bee = $property->getValue($this->beeSwarm)[0];
        static::assertSame(65, $bee->getPoints());
    }

    public function testRandomHitQueen()
    {
        $this->beeSwarm->add(new Queen(new PositiveInteger(100), new PositiveInteger(100)));
        $this->beeSwarm->randomHit();
        // One available way to break encapsulation.
        $reflection = new \ReflectionObject($this->beeSwarm);
        $property = $reflection->getProperty('bees');
        $property->setAccessible(true);
        $bees = $property->getValue($this->beeSwarm);
        static::assertSame([], $bees);
    }

    public function testGetStatistics()
    {
        $expect = [
            Drone::class => [50],
        ];
        $this->beeSwarm->add(new Drone(new PositiveInteger(50), new PositiveInteger(12)));
        static::assertSame($expect, $this->beeSwarm->getStatistics());
    }
}
