<?php
namespace PTK\DonRac\Task;

use pocketmine\Server;
use PTK\DonRac\Main;

/**
 * Class TaskCreator
 * @package PTK\DonRac\Task
 */
class TaskCreator
{
    function __construct()
    {
        $this->main = Main::getInstance();
        $this->createTasks($this->main);
    }

    /**
     * @param Main $main
     */
    private function createTasks(Main $main)
    {
        Server::getInstance()->getScheduler()->scheduleRepeatingTask(new ClearTask($main), $main->config->getAll()["Clear-time"] * 20);
        Server::getInstance()->getScheduler()->scheduleRepeatingTask(new MsgTask($main), ($main->config->getAll()["Clear-time"] - 60) * 20);
    }
}