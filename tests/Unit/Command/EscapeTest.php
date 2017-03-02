<?php

namespace Test\Unit\Command;

use Command\Escape;
use GamePlay\Game;
use State\End as StateEnd;

class EscapeTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
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
        $command = new Escape();
        /** @var Game $game */
        $command->execute($game);
        // No need assert something, if method will not be invoked we'll receive fail.
    }
}
