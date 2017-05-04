<?php

namespace Test\Unit\Command;

use Bee\Swarm;
use Command\Hit;
use GamePlay\Game;
use State\End as StateEnd;
use State\InProgress as StateInProgress;

class HitTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteQueenAlive()
    {
        $game = $this->getMockBuilder(Game::class)
            ->disableOriginalConstructor()
            ->setMethods(['setState'])
            ->getMock()
        ;
        $game
            ->expects(static::once())
            ->method('setState')
            ->with(static::equalTo(new StateInProgress()))
            ->will(static::returnValue('OK'))
        ;
        $beeSwarm = $this->createMock(Swarm::class);
        $beeSwarm
            ->expects(static::once())
            ->method('randomHit')
            ->will(static::returnValue(null))
        ;
        $beeSwarm
            ->expects(static::once())
            ->method('isQueenAlive')
            ->will(static::returnValue(true))
        ;
        /** @var Game $game */
        /** @var Swarm $beeSwarm */
        $game->setBeeSwarm($beeSwarm);
        $command = new Hit();
        $command->execute($game);
        // No need assert something, if method will not be invoked we'll receive fail.
    }

    public function testExecuteNotQueenAlive()
    {
        $game = $this->getMockBuilder(Game::class)
            ->disableOriginalConstructor()
            ->setMethods(['setState'])
            ->getMock()
        ;
        $game
            ->expects(static::once())
            ->method('setState')
            ->with(static::equalTo(new StateEnd()))
            ->will(static::returnValue('OK'))
        ;
        $beeSwarm = $this->createMock(Swarm::class);
        $beeSwarm
            ->expects(static::once())
            ->method('randomHit')
            ->will(static::returnValue(null))
        ;
        $beeSwarm
            ->expects(static::once())
            ->method('isQueenAlive')
            ->will(static::returnValue(false))
        ;
        /** @var Game $game */
        /** @var Swarm $beeSwarm */
        $game->setBeeSwarm($beeSwarm);
        $command = new Hit();
        $command->execute($game);
        // No need assert something, if method will not be invoked we'll receive fail.
    }
}
