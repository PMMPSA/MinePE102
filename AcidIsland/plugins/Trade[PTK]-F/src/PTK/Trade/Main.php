<?php

namespace PTK\Trade;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\nbt\NBT;
use pocketmine\utils\TextFormat as TF;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TF::BLUE . "Trade Đã Hoạt Động! Plugin Được Viết Bởi PTK-KienPham");
	}
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		if ($cmd->getName() == "trade"){
			$sender->sendMessage(TF::BLUE . "/trade list để xem danh sách gói vật phẩm, sử dụng /trade doi (tên vật phẩm) để đổi vật phẩm");
			if(isset($args[0])){
				switch(strtolower($args[0])){
				case "list":
				$sender->sendMessage(TF::BLUE . "Danh sách các gói vật phẩm đặc biệt (/trade doi (cú pháp) để để đổi)");
				$sender->sendMessage(TF::GREEN . "1.Cúp Sắt Cường Hóa - 3 Thủy Ngọc (cú pháp: cup1)");
				$sender->sendMessage(TF::GREEN . "2.Cúp Kim Cương Cường Hóa - 4 Thổ Ngọc (cú pháp: cup2");
				$sender->sendMessage(TF::GREEN . "3.Cúp Hắc Diện Thạch - 5 Hỏa Ngọc (cú pháp: cup3)");
				$sender->sendMessage(TF::GREEN . "4.Cúp Ánh Sáng - 6 Trái Tim Rồng (cú pháp: cup4)");
				$sender->sendMessage(TF::GREEN . "5.Kiếm Titanium - 5 Trái Tim Rồng (cú pháp: kiem)");
				$sender->sendMessage(TF::GREEN . "6.Set Giáp+Kiếm Khởi Đầu - 15 Hỏa Ngọc (cú pháp: set1)");
				$sender->sendMessage(TF::GREEN . "7.Set Giáp+Kiếm Của Boss - 15 Mắt Thần (cú pháp: set2)");
				$sender->sendMessage(TF::GREEN . "8.Gậy Thông Trĩ Siêu Cấp - 2 Mắt Thần (cú pháp: gttsc)");
				$sender->sendMessage(TF::BLUE . "Ghi /trade list 2 để xem trang tiếp theo ---->");
				   if(isset($args[1])){
					   switch (strtolower($args[1])){
						   case "2":
				           $sender->sendMessage(TF::BLUE . "Danh sách các gói vật phẩm đặc biệt (/trade doi (cú pháp) để để đổi)");
                           $sender->sendMessage(TF::GREEN . "9.16 Quả Táo Vàng Phù Phép - 5 Thủy Ngọc (cú pháp: taovang)");
						   $sender->sendMessage(TF::GREEN . "10.Thủy Ngọc - 64 Khối Ngọc Lục Bảo (cú pháp: thuyngoc)");
						   $sender->sendMessage(TF::GREEN . "11.Thổ Ngọc - 64 Khối Sắt (cú pháp: thongoc)");
						   $sender->sendMessage(TF::GREEN . "12.Hỏa Ngọc - 128 Khối Vàng (cú pháp: hoangoc");
						   $sender->sendMessage(TF::GREEN . "13.Trái Tim Rồng - 5 Hỏa Ngọc (cú pháp: traitimrong");
						   $sender->sendMessage(TF::GREEN . "14.Mắt Thần - 10 Hỏa Ngọc (cú pháp: matthan)");
						   return true;
						   break;
					   }
				   }
				return true;
				case "doi": //Co the edit them neu muon!
				   if(isset($args[1])){ //Trong khi edit cam xoa dong nay!!!!
					   switch (strtolower($args[1])){
						   //Iron Enchant Pickaxe
						  case "cup1":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(257, 0, 1);
						  $name = $item->setCustomName("§r§bCúp Sắt Phù Phép\n§r§cVật Phẩm Không Bán Tại Shop Chỉ Có Thể Trade");
						  if ($sender->getInventory()->getItemInHand()->getId(Item::get(370,0,3))){
							  $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
							  $sender->getInventory()->addItem($item);
                              $item->setCustomName($name);
							  $sender->getInventory()->removeItem(Item::get(370,0,3));
							  $sender->sendMessage(TF::YELLOW . "Bạn đã đổi cúp sắt phù phép với 3 Thủy Ngọc");
						  }
						  else{
							  $sender->sendMessage(TF::RED . "Bạn không có vật phẩm để đổi");
						  }
				          return true;
						  break;
						  //Diamond Enchant Pickaxe
						  case "cup2":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(278, 0, 1);
						  $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($sender->getInventory()->getItemInHand()->getItem(Item::get(336,0,4))){
							  $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
							  $sender->getInventory()->addItem($item);
							  $sender->getInventory()->removeItem(Item::get(336,0,4));
							  $sender->sendMessage(TF::YELLOW . "Bạn đã đổi cúp sắt phù phép với 3 Thổ Ngọc");
						  }
						  else{
							  $sender->sendMessage(TF::RED . "Bạn không có vật phẩm để đổi");
						  }
						  return true;
						  break;
						  //Obisidian Enchant Pickaxe
						  case "obsidian":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(278, 0, 1);
						  $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 1100000){
							  $sender->sendMessage(TF::RED . "Không đủ tiền");
						  }
						  else{
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 11000);
							  $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(7));
							  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
							  $item->addEnchantment(Enchantment::getEnchantment(18)->setLevel(1));
							  $sender->getInventory()->addItem($item);
							  $sender->sendMessage(TF::YELLOW . "Bạn đã mua Obsidian Pickaxe Enchant với giá 11000 xu");
						  }
						  return true;
						  break;
						  //Blaze Enchant Pickaxe
						  case "blaze":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(278, 0, 1);
						  $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 15000){
							  $sender->sendMessage(TF::RED . "Không đủ tiền");
						  }
						  else{
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 15000);
							  $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(9));
							  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
							  $item->addEnchantment(Enchantment::getEnchantment(18)->setLevel(2));
							  $sender->getInventory()->addItem($item);
							  $sender->sendMessage(TF::YELLOW . "Bạn đã mua Blaze Pickaxe Enchant với giá 15000 xu");
					     }
						 return true;
						 break;
						 //Stack of Diamond
						 case "stackdia":
						 $p = $this->getServer()->getPlayer($sender->getName());
						 $item = Item::get(264, 0, 64);
						 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						 if ($money < 35000000){
							 $sender->sendMessage(TF::RED . "Không đủ tiền");
						 }
						 else{
							 $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 3500);
							 $sender->getInventory()->addItem($item);
							 $sender->sendMessage(TF::YELLOW . "Bạn đã mua 64 Diamond với giá 3500 xu");
						 }
						 return true;
						 break;
						 case "sbpack":
						 $p = $this->getServer()->getPlayer($sender->getName());
						 $item1 = Item::get(8, 0, 16);
						 $item2 = Item::get(10, 0, 8);
						 $item3 = Item::get(352, 0, 32);
						 $item4 = Item::get(6, 0, 16);
						 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						 if ($money < 25000){
							 $sender->sendMessage(TF::RED . "Không đủ tiền");
						 }
						 else{
							 $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 2500);
							 $sender->getInventory()->addItem($item1);
							 $sender->getInventory()->addItem($item2);
							 $sender->getInventory()->addItem($item3);
							 $sender->getInventory()->addItem($item4);
							 $sender->sendMessage(TF::YELLOW . "Bạn đã mua Gói Skyblock với giá 2500 xu");
						 }
						 return true;
						 break;
						 case "thanhgiong":
						 $p = $this->getServer()->getPlayer($sender->getName());
						 $item1 = Item::get(310, 0, 1);
						 $item2 = Item::get(311, 0, 1);
						 $item3 = Item::get(312, 0, 1);
						 $item4 = Item::get(313, 0, 1);
						 $item5 = Item::get(276, 0, 1);
						 $item6 = Item::get(278, 0, 1);
						 $name1 = $item1->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $name2 = $item2->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $name3 = $item3->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $name4 = $item4->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $name5 = $item5->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $name6 = $item6->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						 if ($money < 8500000){
							 $sender->sendMessage(TF::RED . "Không đủ tiền");
						 }
						 else{
					         $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 85000);
				             $item1->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item1->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item1->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item2->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item2->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item2->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item3->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item3->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item3->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item4->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item4->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item4->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item5->addEnchantment(Enchantment::getEnchantment(9)->setLevel(5));
							 $item5->addEnchantment(Enchantment::getEnchantment(12)->setLevel(2));
							 $item5->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item6->addEnchantment(Enchantment::getEnchantment(15)->setLevel(9));
							 $item6->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $sender->getInventory()->addItem($item1);
							 $sender->getInventory()->addItem($item2);
							 $sender->getInventory()->addItem($item3);
							 $sender->getInventory()->addItem($item4);
							 $sender->getInventory()->addItem($item5);
							 $sender->getInventory()->addItem($item6);
							 $item1->setCustomName($name1);
							 $item2->setCustomName($name2);
							 $item3->setCustomName($name3);
							 $item4->setCustomName($name4);
							 $item5->setCustomName($name5);
							 $item6->setCustomName($name6);
							 $sender->sendMessage(TF::YELLOW . "Bạn đã chính thức trở thành Thánh Gióng với $name1 trị giá 100k xu");
						 }
						 return true;
						 break;
						 case "itemboss":
						 $p = $this->getServer()->getPlayer($sender->getName());
						 $item1 = Item::get(310, 0, 1);
						 $item2 = Item::get(311, 0, 1);
						 $item3 = Item::get(312, 0, 1);
						 $item4 = Item::get(313, 0, 1);
						 $item5 = Item::get(276, 0, 1);
						 $item6 = Item::get(278, 0, 1);
						 $name1 = $item1->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Mũ Của Boss§b<•");
						 $name2 = $item2->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Áo Của Boss§b<•");
						 $name3 = $item3->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Quần Của Boss§b<•");
						 $name4 = $item4->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Giày Của Boss§b<•");
						 $name5 = $item5->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Kiếm Của Boss§b<•");
						 $name6 = $item6->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Cúp Của Boss§b<•");
						 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						 if ($money < 99999999999999999){
							 $sender->sendMessage(TF::RED . "Không đủ tiền");
						 }
						 else{
					         $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 99999999999999999);
				             $item1->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item1->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item1->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item2->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item2->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item2->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item3->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item3->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item3->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item4->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
							 $item4->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
							 $item4->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item5->addEnchantment(Enchantment::getEnchantment(9)->setLevel(5));
							 $item5->addEnchantment(Enchantment::getEnchantment(12)->setLevel(2));
							 $item5->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $item6->addEnchantment(Enchantment::getEnchantment(15)->setLevel(9));
							 $item6->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							 $sender->getInventory()->addItem($item1);
							 $sender->getInventory()->addItem($item2);
							 $sender->getInventory()->addItem($item3);
							 $sender->getInventory()->addItem($item4);
							 $sender->getInventory()->addItem($item5);
							 $sender->getInventory()->addItem($item6);
							 $item1->setCustomName($name1);
							 $item2->setCustomName($name2);
							 $item3->setCustomName($name3);
							 $item4->setCustomName($name4);
							 $item5->setCustomName($name5);
							 $item6->setCustomName($name6);
							 $sender->sendMessage(TF::YELLOW . "Bạn đã chính thức trở thành Boss Trong Server với $name1 trị giá 99999999999999999 xu");
						 }

						 return true;
						 break;
						 case "gaythongtri":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(280, 0, 1);
						  $name = $item->setCustomName("§aGậy Thông Trĩ Siêu Cấp");
		                  $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 400000){
							  $sender->sendMessage(TF::RED . "Không đủ tiền");
						  }
						  else{
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 400000);
							  $item->addEnchantment(Enchantment::getEnchantment(9)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
							  $item->addEnchantment(Enchantment::getEnchantment(10)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(11)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(12)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(13)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(14)->setLevel(5));
							  $sender->getInventory()->addItem($item);
							  $item->setCustomName($name);
							  $sender->sendMessage(TF::YELLOW . "Bạn đã mua Iron Gậy Thông Trĩ với giá 400000 xu");
						  }
				          return true;
						  break;
						//Gian hàng ngày Tết (chỉ mở bán nhân Tết!)
						case "c":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(339, 0, 1);
						$name = $item->setCustomName("§c§lC");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 2000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 2000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua chữ C với giá 4000 xu");
						}
						return true;
						break;
						case "h":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(339, 0, 1);
						$name = $item->setCustomName("§c§lH");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 2000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 2000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua chữ H với giá 4000 xu");
						}
						return true;
						break;
						case "u":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(339, 0, 1);
						$name = $item->setCustomName("§c§lU");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 2000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 2000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua chữ U với giá 4000 xu");
						}
						return true;
						break;
						case "tet":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(339, 0, 1);
						$name = $item->setCustomName("§c§lTET");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 8000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 8000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua chữ TET với giá 9000 xu");
						}
						return true;
						break;
						case "m":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(339, 0, 1);
						$name = $item->setCustomName("§c§lM");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 2000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 4000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua chữ M với giá 4000 xu");
						}
						return true;
						break;
						case "y":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(339, 0, 1);
						$name = $item->setCustomName("§c§lY");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 2000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 2000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua chữ Y với giá 4000 xu");
						}
						return true;
						break;
						case "s":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(339, 0, 1);
						$name = $item->setCustomName("§c§lS");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 2000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 2000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua chữ S với giá 4000 xu");
						}
						return true;
						break;
						case "ngocdo":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(372, 0, 1);
						$name = $item->setCustomName("§c§lNgọc Đỏ");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 90000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 90000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua Ngọc Đỏ với giá 90000 xu");
						}
						return true;
						break;
						case "ngocxanh":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(351, 4, 1);
						$name = $item->setCustomName("§c§lNgọc Xanh");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 90000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 90000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua Ngọc Xanh với giá 90000 xu");
						}
						return true;
						break;
						case "ngocvang":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(371, 0, 1);
						$name = $item->setCustomName("§c§lNgọc Vàng");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 90000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 90000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua Ngọc Vàng với giá 90000 xu");
						}
						return true;
						break;
						case "ngocga":
						$p = $this->getServer()->getPlayer($sender->getName());
						$item = Item::get(266, 0, 1);
						$name = $item->setCustomName("§c§lNgọc In Dấu Gà");
						$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						if ($money < 90000){
							$sender->sendMessage(TF::RED . "Không đủ tiền");
						}
						else{
							$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 90000);
							$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(1));
							$sender->getInventory()->addItem($item);
							$item->setCustomName($name);
							$sender->sendMessage(TF::YELLOW . "Bạn đã mua Ngọc In Dấu Gà với giá 90000 xu");
						}
						return true;
						break;
				}
				return true;
			}
		}
	}
	
}
}
}