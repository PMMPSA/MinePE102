<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;

class HelpSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return $sender->hasPermission("myplot.command.help");
    }

    /**
     * @return \MyPlot\Commands
     */
    private function getCommandHandler()
    {
        return $this->getPlugin()->getCommand($this->translateString("command.name"));
    }

    public function execute(CommandSender $sender, array $args) {
        if (count($args) === 0) {
            $pageNumber = 1;
        } elseif (is_numeric($args[0])) {
            $pageNumber = (int) array_shift($args);
            if ($pageNumber <= 0) {
                $pageNumber = 1;
            }
        } else {
            return false;
        }

        if ($sender instanceof ConsoleCommandSender) {
            $pageHeight = PHP_INT_MAX;
        } else {
            $pageHeight = 5;
        }

        $commands = [];
        foreach ($this->getCommandHandler()->getCommands() as $command) {
            if ($command->canUse($sender)) {
                $commands[$command->getName()] = $command;
            }
        }
        ksort($commands, SORT_NATURAL | SORT_FLAG_CASE);
        $commands = array_chunk($commands, $pageHeight);
        /** @var SubCommand[][] $commands */

							//////
            $sender->sendMessage("§c•==========•§2SkyBlock§f•§eHelp§c•==========•");
			$sender->sendMessage("§2/sb play: §fĐi đến một hòn đảo");
			$sender->sendMessage("§2/sb claim: §fMua ngay hòn đảo bạn đang đứng");
			$sender->sendMessage("§2/sb addhelper <player>: §fThêm người vào đảo của bạn");
			$sender->sendMessage("§2/sb removehelper <player>: §fXóa người chơi trong đảo của bạn");
			$sender->sendMessage("§2/sb homes: §fDanh sách đảo của bạn");
			$sender->sendMessage("§2/sb home: §fDịch chuyển về đảo của bạn");
			$sender->sendMessage("§2/sb info: §fXem thông tin hòn đảo");
			$sender->sendMessage("§2/sb give <player>: §fCho người khác hòn đảo của bạn");
			$sender->sendMessage("§2/sb warp <X;Y>: §fDi chuyển đến hòn đảo nào đó");
			$sender->sendMessage("§2/sb dispose: §fBỏ đi đảo của bạn");
			$sender->sendMessage("§2/sb name <name>: §fĐặt hoặc đổi tên đảo của bạn");
        return true;
    }
}
