<?php

namespace ClientInterface;

use State\StateInterface;

/**
 * Cli.
 *
 * This class provides ability to play game in CLI environment (console/terminal).
 */
class Cli implements ClientInterfaceInterface
{
    private $stream;

    /**
     * Cli constructor.
     *
     * @param bool|resource $stream Input stream.
     */
    public function __construct($stream = STDIN)
    {
        $this->stream = $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function getCommand(StateInterface $state)
    {
        echo "\n".$state->getPromptMessage();
        $confirmation = trim(fgets($this->stream));
        if ($confirmation === 'n') {
            $command = $state->getNotPromptedCommand();
        } else {
            $command = $state->getPromptedCommand();
        }
        return $command;
    }

    /**
     * {@inheritdoc}
     */
    public function outputStatistics(array $statistics)
    {
        foreach ($statistics as $beeType => $points) {
            echo "\n$beeType: ".implode(' ', $points);
        }
    }
}
