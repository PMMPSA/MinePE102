<?php

namespace FJ;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\Inventory;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

Class FJ extends PluginBase implements Listener{

public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
}
public function FJ(PlayerJoinEvent $event){
   $sender = $event->getPlayer();
   $name = $sender->getName();
      if($sender->hasPlayedBefore() == false){
   $item1 = Item::get(267, 0, 1);
   $item1->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $item1->addEnchantment(Enchantment::getEnchantment(9)->setLevel(1));
   $sender->getInventory()->addItem($item1);

   $item2 = Item::get(257, 0, 1);
   $item2->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $item2->addEnchantment(Enchantment::getEnchantment(15)->setLevel(1));
   $sender->getInventory()->addItem($item2);

   $item3 = Item::get(258, 0, 1);
   $item3->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $item3->addEnchantment(Enchantment::getEnchantment(15)->setLevel(1));
   $sender->getInventory()->addItem($item3);

   $item4 = Item::get(256, 0, 1);
   $item4->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $item4->addEnchantment(Enchantment::getEnchantment(15)->setLevel(1));
   $sender->getInventory()->addItem($item4);

   $armor1 = Item::get(298, 0, 1);
   $armor1->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $armor1->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1));
   $sender->getInventory()->addItem($armor1);

   $armor2 = Item::get(303, 0, 1);
   $armor2->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $armor2->addEnchantment(Enchantment::getEnchantment(0)->setLevel(3));
   $armor2->addEnchantment(Enchantment::getEnchantment(1)->setLevel(3));
   $sender->getInventory()->addItem($armor2);

   $armor3 = Item::get(300, 0, 1);
   $armor3->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $armor3->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1));
   $sender->getInventory()->addItem($armor3);

   $armor4 = Item::get(301, 0, 1);
   $armor4->setCustomName("§l§cHÀNG§f•=•§eKHỦNG");
   $armor4->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1));
   $sender->getInventory()->addItem($armor4);

   $sender->getInventory()->addItem(Item::get(17, 0, 64));
   $sender->getInventory()->addItem(Item::get(4, 0, 64));
   $sender->getInventory()->addItem(Item::get(35, 0, 9));
   $sender->getInventory()->addItem(Item::get(260, 0, 18));
   $sender->getInventory()->addItem(Item::get(297, 0, 18));
   $sender->getInventory()->addItem(Item::get(364, 0, 32));
   $sender->sendMessage("§c× §fGửi tặng bạn quà, lần đầu vào SV!!! §c×");
}
}
public function onDisable(){}
}
?>