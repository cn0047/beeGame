<?php

namespace Builder;

use VO\PositiveInteger;
use VO\NotEmptyString;
use Bee\Swarm;
use Bee\Factory;
use Config\Config;

/**
 * Main builder.
 *
 * This is builder that build all things necessary for game.
 * Encapsulates all game initialization logic.
 */
class Main
{
    /** @var array $allowedBeeTypes Specify particular types of bee that allowed in this particular builder. */
    private static $allowedBeeTypes = [
        'Queen',
        'Worker',
        'Drone',
    ];

    /** @var Config $config Contains configuration of game for particular game level. */
    private $config;

    /** @var Swarm $beeSwarm Contains bee aggregate.*/
    private $beeSwarm;

    /**
     * Constructor.
     *
     * @param NotEmptyString $level Contains level by which will be loaded configs.
     */
    public function __construct(NotEmptyString $level)
    {
        $configName = "Config\\$level";
        $this->config = new $configName();
    }

    /**
     * Builds all game objects.
     *
     * @throws \InvalidArgumentException In case when factory cannot create bee.
     */
    public function buildLevel()
    {
        $factory = new Factory();
        $this->beeSwarm = new Swarm();
        // Receive configs and create bees.
        foreach (self::$allowedBeeTypes as $beeName) {
            $lifespan = $this->config->get(new NotEmptyString("lifespan$beeName"));
            $deduceStep = $this->config->get(new NotEmptyString("deduceStep$beeName"));
            $count = $this->config->get(new NotEmptyString("count$beeName"));
            // Fill bee swarm.
            for ($i = 0; $i < $count; $i++) {
                $this->beeSwarm->add($factory->create(
                    new NotEmptyString($beeName),
                    new PositiveInteger($lifespan),
                    new PositiveInteger($deduceStep)
                ));
            }
        }
        // This help improve random behaviour..
        $this->beeSwarm->shuffle();
    }

    /**
     * Provides access to bee swarm aggregate.
     *
     * @return Swarm Bee swarm.
     */
    public function getBeeSwarm()
    {
        return $this->beeSwarm;
    }
}
