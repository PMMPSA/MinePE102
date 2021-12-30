<?php
/**
 * Created by PhpStorm.
 * User: Jarne
 * Date: 10.08.16
 * Time: 19:01
 */

namespace b;

use pocketmine\plugin\PluginBase;
use pocketmine\event\level\LevelLoadEvent;
use pocketmine\Server;

class b extends PluginBase {

    public function onEnable() {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		foreach(glob($this->getServer()->getDataPath() . "worlds/*") as $world) {
    $world = str_replace($this->getServer()->getDataPath() . "worlds/", "", $world);
    if($this->getServer()->isLevelLoaded($world)){
      continue;
    }
    $this->getServer()->loadLevel($world);
  }

    }
}
