<?php

namespace MF;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\Inventory;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

Class JI extends PluginBase implements Listener{

public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
}
public function JoinItems(PlayerJoinEvent $event){
   $sender = $event->getPlayer();
   $name = $sender->getName();
      if($sender->hasPlayedBefore() == false){
   $item1 = Item::get(340, 0, 1);
   $item1->setCustomName("§d Item này sẽ giúp bạn tìm hiểu cách chơi trong máy chủ §c1§f0§d2§6PE\n§b Ấn giữ để sử dụng");
   $item1->addEnchantment(Enchantment::getEnchantment(1000)->setLevel(0));
   $sender->getInventory()->addItem($item1);

   $item3 = Item::get(403, 0, 1);
   $item3->setCustomName("§a Quy Định - Luật Chơi - §c1§f0§d2§6PE\n§b Ấn giữ để sử dụng");
   $item3->addEnchantment(Enchantment::getEnchantment(1000)->setLevel(0));
   $sender->getInventory()->addItem($item3);

   $armor2 = Item::get(377, 0, 1);
   $armor2->setCustomName("§a Cách Giảm Lag Cho Máy Yếu\n§b Ấn giữ để sử dụng");
   $armor2->addEnchantment(Enchantment::getEnchantment(1000)->setLevel(0));
   $sender->getInventory()->addItem($armor2);

   $armor3 = Item::get(403, 1, 1);
   $armor3->setCustomName("§a Thông Tin Giới Thiệu Về §c1§f0§d2§6PE\n§b Ấn giữ để sử dụng");
   $armor3->addEnchantment(Enchantment::getEnchantment(1000)->setLevel(0));
   $sender->getInventory()->addItem($armor3);

   $armor4 = Item::get(403, 2, 1);
   $armor4->setCustomName("§a Tố Cáo - Báo Lỗi\n§b Ấn giữ để sử dụng");
   $armor4->addEnchantment(Enchantment::getEnchantment(1000)->setLevel(0));
   $sender->getInventory()->addItem($armor4);
   
   $armor5 = Item::get(403, 3, 1);
   $armor5->setCustomName("§a Thông Báo - Tuyển Dụng\n§b Ấn giữ để sử dụng");
   $armor5->addEnchantment(Enchantment::getEnchantment(1000)->setLevel(0));
   $sender->getInventory()->addItem($armor5);

   $sender->sendMessage("§c=+= §aChào bạn kiểm tra túi đồ để xem cách chơi nhé §c=+=");
}
}
public function onDisable(){}
}
?>