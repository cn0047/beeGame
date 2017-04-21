<?php

namespace Test\Unit\State;

use Command\CommandInterface;
use State\End;

class EndTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPromptMessage()
    {
        $msg = (new End())->getPromptMessage();
        static::assertNotEmpty($msg);
        static::assertInternalType('string', $msg);
    }

    public function testGetPromptedCommand()
    {
        static::assertInstanceOf(CommandInterface::class, (new End())->getPromptedCommand());
    }

    public function testGetNotPromptedCommand()
    {
        static::assertNull(null, (new End())->getNotPromptedCommand());
    }
}
