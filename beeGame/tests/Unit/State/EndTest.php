<?php

namespace Test\Unit\State;

use Command\CommandInterface;
use State\End;

class EndTest extends \PHPUnit_Framework_TestCase
{
    /** @var End */
    private $state;

    protected function setUp()
    {
        $this->state = new End();
    }

    public function testGetNotPromptedCommand()
    {
        static::assertNull(null, $this->state->getNotPromptedCommand());
    }
}
