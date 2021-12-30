<?php
namespace PTK\DonRac\Entity;

use pocketmine\entity\Creature;
use pocketmine\entity\Human;
use pocketmine\Server;
use PTK\DonRac\Main;

/*
 * 
 */

/**
 * Class EntityManager
 * @package PTK\DonRac\Entity
 */
class EntityManager
{
    function __construct(Main $main)
    {
        $this->main = $main;
    }

    /**
     * @return Main
     */
    function getMain()
    {
        return $this->main;
    }
    /**
     * @return int
     */
    function removeEntities()
    {
        $entitiesCount = 0;
        foreach (Server::getInstance()->getLevels() as $level) {
            foreach ($level->getEntities() as $entity) {
                if (!$entity instanceof Creature and !$entity instanceof Human) {
                    $entity->close();
                    $entitiesCount++;
                }
            }
        }
        return $entitiesCount;
    }

    /**
     * @return int
     */
    function removeMobs()
    {
        $mobsCount = 0;
        foreach (Server::getInstance()->getLevels() as $level) {
            foreach ($level->getEntities() as $entity) {
                if ($entity instanceof Creature && !($entity instanceof Human)) {
                    $entity->kill();
                    $mobsCount++;
                }
            }
        }
        return $mobsCount;
    }
}