<?php

namespace Test\Unit\State;

use Command\CommandInterface;
use State\Begin;

class BeginTest extends \PHPUnit_Framework_TestCase
{
    /** @var Begin */
    private $state;

    protected function setUp()
    {
        $this->state = new Begin();
    }

    public function testGetNotPromptedCommand()
    {
        static::assertInstanceOf(CommandInterface::class, $this->state->getNotPromptedCommand());
    }
}
