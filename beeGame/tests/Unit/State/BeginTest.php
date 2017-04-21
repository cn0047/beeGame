<?php

namespace Test\Unit\State;

use Command\CommandInterface;
use State\Begin;

class BeginTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPromptMessage()
    {
        $msg = (new Begin())->getPromptMessage();
        static::assertNotEmpty($msg);
        static::assertInternalType('string', $msg);
    }

    public function testGetPromptedCommand()
    {
        static::assertInstanceOf(CommandInterface::class, (new Begin())->getPromptedCommand());
    }

    public function testGetNotPromptedCommand()
    {
        static::assertInstanceOf(CommandInterface::class, (new Begin())->getNotPromptedCommand());
    }
}
