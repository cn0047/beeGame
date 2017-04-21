<?php

namespace Test\Unit\State;

use Command\CommandInterface;
use State\InProgress;

class InProgressTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPromptMessage()
    {
        $msg = (new InProgress())->getPromptMessage();
        static::assertNotEmpty($msg);
        static::assertInternalType('string', $msg);
    }

    public function testGetPromptedCommand()
    {
        static::assertInstanceOf(CommandInterface::class, (new InProgress())->getPromptedCommand());
    }

    public function testGetNotPromptedCommand()
    {
        static::assertInstanceOf(CommandInterface::class, (new InProgress())->getNotPromptedCommand());
    }
}
