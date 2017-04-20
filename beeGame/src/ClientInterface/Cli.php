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
    /**
     * {@inheritdoc}
     */
    public function getCommand(StateInterface $state)
    {
        echo "\n".$state->getPromptMessage();
        $confirmation = trim(fgets(STDIN));
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
