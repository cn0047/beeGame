<?php

require_once __DIR__ . '/bootstrap.php';

if (PHP_SAPI === 'cli') {
    $clientInterface = new \ClientInterface\Cli();
} else {
    $clientInterface = new \ClientInterface\CGI();
}

$game = new \GamePlay\Game($clientInterface);
$game->play();