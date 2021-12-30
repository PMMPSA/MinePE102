<?php
namespace PTK\DonRac\Task;

use pocketmine\utils\TextFormat as F;
use pocketmine\scheduler\PluginTask;
use pocketmine\Server;
use PTK\DonRacMain;

/**
 * Class ClearTask
 * @package PTK\DonRac\Task
 */
class ClearTask extends PluginTask
{
    /**
     * @param Main $main
     */
    function __construct(Main $main)
    {
        parent::__construct($main);
        $this->plugin = $main;
    }

    /**
     * @param $currentTick
     */
    function onRun($currentTick)
    {
        $msg = Main::getInstance()->config->get("Clear-msg");
        $msg = str_replace("@count", Main::getInstance()->getEntityManager()->removeEntities(), $msg);
        Server::getInstance()->broadcastMessage(F::GREEN . $msg);
        Server::getInstance()->broadcastMessage(F::RED . "§b[§c1§f0§d2§ePE§6-§9Dọn Rác§b]§c Chúng tôi không chịu trách nghiệm nếu bạn thả đồ quý ở đất!);
    }
}