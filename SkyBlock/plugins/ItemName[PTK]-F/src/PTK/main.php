<?php


namespace PTK;
use pocketmine\event\player\{PlayerInteractEvent, PlayerJoinEvent};
use pocketmine\utils\TextFormat as TF;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\level\sound\ExpPickupSound;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class main extends PluginBase implements Listener{

  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    if(!$sender instanceof Player) return;
    switch(strtolower($cmd->getName())){
      case "iname":
       if($sender->hasPermission("itemname")){
        $name = $args[0];
          $item = $sender->getInventory()->getItemInHand();
          $sender->sendMessage("§aItem đã được sửa tên thành§9 " . $name . "§r§7!");
          $item->setCustomName($name);
          $sender->getInventory()->setItemInHand($item);
          $sender->getLevel()->addSound(new EndermanTeleportSound($sender), [$sender]);
  }else{
      $sender->sendMessage("§cDu hast keine Erlaubnis um dein Item umzubennen!");
  }
  break;
      case "ininfo":
          $sender->sendMessage("§aBesuche unsere Website! §7-> §adreambuild.de");
          $sender->sendMessage("§aBesuche unseren Server! §7-> §aplay.dreambuild.de");
          $sender->sendMessage("§bEin Plugin von AlphaMisery!");
    }
  }
}//ende