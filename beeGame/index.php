<?php

require_once __DIR__ . '/bootstrap.php';

if (PHP_SAPI === 'cli') {
    $clientInterface = new \ClientInterface\Cli();
} else {
    throw new \RuntimeException('This interface is not supported.');
}

$game = new \GamePlay\Game($clientInterface);
$game->play();
