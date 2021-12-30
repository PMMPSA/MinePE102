<?php

namespace BoGItem;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\entity\Entity;
use pocketmine\entity\Effect;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use PTK\NapThe\Main;
use PTK\NapThe\NapTheAPI;

class BoGItem extends PluginBase implements Listener {

public $Main;

  public function onEnable(){
   $this->EconomyS = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
   $this->Main = $this->getServer()->getPluginManager()->getPlugin("NapThe[PTK]-F");
}

  public function onCommand(CommandSender $sender,Command $command,$label,array $args){
	   if($command == "mua"){
		   if(!isset($args[0])){
			   $sender->sendMessage("§a=- §eDanh sách gói hàng §a-=");
			   $sender->sendMessage("§a• §6/mua skyblock§b - Giá 15 point, gói skyblock");
			   $sender->sendMessage("§a• §6/mua tool§b - Giá 25 point, gói tool đặc biệt");
			   $sender->sendMessage("§a• §6/mua super§b - Giá 35 point, gói siêu cấp");
			   $sender->sendMessage("§fLưu ý các gói hàng chỉ bán bằng §6Point ");
			   $sender->sendMessage("§c----------------------------");
		 	 	 return true;
		}
			switch($args[0]){
				case "skyblock":
    $p1 = $sender->getPlayer();
    if (!$this->Main->api->take($sender->getName(), abs(15))){
	$sender->sendMessage("§a- Không đủ Point để mua");
	return false;
	}
   $sender->getInventory()->addItem(Item::get(8, 0, 3));
   $sender->getInventory()->addItem(Item::get(10, 0, 3));
   $sender->getInventory()->addItem(Item::get(4, 0, 64));
   $sender->getInventory()->addItem(Item::get(17, 0, 64));
   $sender->getInventory()->addItem(Item::get(264, 0, 7));
   $sender->getInventory()->addItem(Item::get(265, 0, 12));
   $sender->getInventory()->addItem(Item::get(266, 0, 9));
   $sender->getInventory()->addItem(Item::get(285, 0, 1));
   $sender->getInventory()->addItem(Item::get(297, 0, 20));
   $this->EconomyS->addMoney($p1, 2525);
       $sender->sendMessage("§f• §aMua gói Tân Thủ thành công, chúc bạn chơi vui vẻ");
	   return true;
	   case "tool":
    $p1 = $sender->getPlayer();
    if (!$this->Main->api->take($sender->getName(), abs(25))){
	$sender->sendMessage("§a- Không đủ Point để mua");
	return false;
	}
   $sender->getInventory()->addItem(Item::get(8, 0, 6));
   $sender->getInventory()->addItem(Item::get(10, 0, 6));
   $sender->getInventory()->addItem(Item::get(278, 0, 2));
   $sender->getInventory()->addItem(Item::get(286, 0, 2));
   $sender->getInventory()->addItem(Item::get(17, 0, 120));
   $sender->getInventory()->addItem(Item::get(315, 0, 1));
   $sender->getInventory()->addItem(Item::get(320, 0, 30));
   $sender->getInventory()->addItem(Item::get(322, 0, 10));
   $sender->getInventory()->addItem(Item::get(351, 15, 35));
   $sender->getInventory()->addItem(Item::get(397, 5, 1));
   $sender->getInventory()->addItem(Item::get(130, 0, 2));
   $this->EconomyS->addMoney($p1, 5000);
       $sender->sendMessage("§f• §aMua gói Mine thành công, chúc bạn chơi vui vẻ");
	   return true;
	   case "super":
    $p1 = $sender->getPlayer();
    if (!$this->Main->api->take($sender->getName(), abs(35))){
	$sender->sendMessage("§a- Không đủ Point để mua");
	return false;
	}
	$sender->getInventory()->addItem(Item::get(8, 0, 10));
   $sender->getInventory()->addItem(Item::get(10, 0, 10));
   $sender->getInventory()->addItem(Item::get(310, 0, 1));
   $sender->getInventory()->addItem(Item::get(315, 0, 1));
   $sender->getInventory()->addItem(Item::get(312, 0, 1));
   $sender->getInventory()->addItem(Item::get(317, 0, 1));
   $sender->getInventory()->addItem(Item::get(17, 0, 240));
   $sender->getInventory()->addItem(Item::get(264, 0, 20));
   $sender->getInventory()->addItem(Item::get(322, 0, 15));
   $sender->getInventory()->addItem(Item::get(412, 0, 50));
   $sender->getInventory()->addItem(Item::get(130, 0, 4));
   $sender->getInventory()->addItem(Item::get(397, 5, 1));
   $sender->getInventory()->addItem(Item::get(351, 15, 64));
   $this->EconomyS->addMoney($p1, 7000);
       $sender->sendMessage("§f• §aMua gói Super thành công, chúc bạn chơi vui vẻ");
	   return true;
}
}
}
}
