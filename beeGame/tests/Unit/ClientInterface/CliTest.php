<?php

namespace Test\Unit\ClientInterface;

use ClientInterface\Cli;
use Command\CommandInterface;
use State\Begin;

class CliTest extends \PHPUnit_Framework_TestCase
{
    private $streamFileName = '/tmp/beeGame.cli.test';

    public function answersProvider()
    {
        return [
            [function() {
                file_put_contents($this->streamFileName, "y\n");
            }],
            [function() {
                file_put_contents($this->streamFileName, "n\n");
            }],
        ];
    }

    /**
     * @param callable $prepareAnswer Function which prepare answer for CLI question.
     *
     * @dataProvider answersProvider
     */
    public function testGetCommand($prepareAnswer)
    {
        $prepareAnswer();
        ob_start();
        $cli = new Cli(fopen($this->streamFileName, 'rb'));
        $command = $cli->getCommand(new Begin());
        $output = ob_get_clean();
        static::assertEquals("\nAre you ready to start game (y/n)?", $output);
        static::assertInstanceOf(CommandInterface::class, $command);
    }

    public function testOutputStatistics()
    {
        $cli = new Cli();
        ob_start();
        $cli->outputStatistics(['Drone' => [50, 38]]);
        $output = ob_get_clean();
        static::assertContains('Drone: 50 38', $output);
    }
}
