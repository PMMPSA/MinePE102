<?php
/**
 * Created by PhpStorm.
 * User: Jarne
 * Date: 10.08.16
 * Time: 19:02
 */

namespace b;

use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\level\Position;
use pocketmine\level\Level;

class EventListener implements Listener {
    private $hotBlock;

    public function __construct(b $hotBlock) {
        $this->hotBlock = $hotBlock;
		$hotBlock->getServer()->getPluginManager()->registerEvents($this, $hotBlock);
    }

    public function onPlayerMove(PlayerMoveEvent $event) {
        $player = $event->getPlayer();
        $world = $player->getLevel();
        $block = $world->getBlock($player->floor()->subtract(0, 1));

        if($world->getName() == $this->getHotBlock()->getConfig()->get("world")) {
            if($block->getId() === 152 and $block->getDamage() === 0){
	  $name = $player->getName();
	$player->teleport(new Position(90, 66, 90, $this->hotBlock->getServer()->getLevelByName("AcidIsland")));
  }
        }
    }

    /**
     * @return HotBlock
     */
    public function getHotBlock(): b {
        return $this->hotBlock;
    }
}