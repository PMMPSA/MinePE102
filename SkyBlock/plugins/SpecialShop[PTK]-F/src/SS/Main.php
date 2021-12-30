<?php

namespace SS;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TF::BLUE . "Special Shop Đã Hoạt Động! Plugin Được Viết Bởi PTK-KienPham");
	}
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		if ($cmd->getName() == "ss"){
			$sender->sendMessage(TF::BLUE . "/ss list để xem danh sách gói vật phẩm, sử dụng /ss buy (cú pháp) để mua");
			if(isset($args[0])){
				switch(strtolower($args[0])){
				case "list":
				$sender->sendMessage(TF::YELLOW . "Danh sách các gói vật phẩm đặc biệt (/ss buy (cú pháp) để mua)");
				$sender->sendMessage(TF::BLUE . "1 - Cúp sắt cường hóa - 400000 xu (cú pháp: iron)");
				$sender->sendMessage(TF::BLUE . "2 - Cúp kim cương cường hóa - 900000 xu (cú pháp: dia");
				$sender->sendMessage(TF::BLUE . "3 - Cúp hắc diện thạch cường hóa - 1100000 xu (cú pháp: obsidian)");
				$sender->sendMessage(TF::BLUE . "4 - Cúp bùng cháy cường hóa - 1500000 xu (cú pháp: blaze)");
				$sender->sendMessage(TF::BLUE . "5 - Gói Diamond - 3500000 xu (cú pháp: stackdia)");
				$sender->sendMessage(TF::BLUE . "6 - Gói Skyblock (16 nước, 8 dung nham, 32 xương, 16 mầm cây sồi) - 2500 xu (cú pháp: sbpack)");
				$sender->sendMessage(TF::BLUE . "7 - Gói Truyền Thuyết Thánh Gióng - 85000000 xu (cú pháp: thanhgiong)");
				$sender->sendMessage(TF::BLUE . "8 - Gậy Thông Trĩ Siêu Cấp - 400000 xu (cú pháp: gaythongtri)");
				$sender->sendMessage(TF::YELLOW . "Nhấn /ss list 2 để xem trang tiếp theo ---->");
				   if(isset($args[1])){
					   switch (strtolower($args[1])){
						   case "2":
                                                   $sender->sendMessage(TF::BLUE . "9 - Set Boss Item - 6969696969696969 xu (cú pháp: itemboss)");
						   $sender->sendMessage(TF::BLUE . "10 - Chữ C - 2000 xu (cú pháp: c)");
						   $sender->sendMessage(TF::BLUE . "11 - Chữ H - 2000 xu (cú pháp: h)");
						   $sender->sendMessage(TF::BLUE . "12 - Chữ U - 2000 xu (cú pháp: u");
						   $sender->sendMessage(TF::BLUE . "13 - Chữ TET - 8000 xu (cú pháp: tet");
						   $sender->sendMessage(TF::BLUE . "14 - Chữ M - 2000 xu (cú pháp: m)");
						   $sender->sendMessage(TF::BLUE . "15 - Chữ Y - 2000 xu (cú pháp: y)");
						   $sender->sendMessage(TF::BLUE . "16 - Chữ S - 2000 xu (cú pháp: s)");
						   $sender->sendMessage(TF::YELLOW . "Nhấn /ss list 3 để xem trang tiếp theo ---->");
						   return true;
						   break;
						   case "3":
						   $sender->sendMessage(TF::BLUE . "17 - Ngọc Màu Đỏ (Tết) - 90000 xu (cú pháp: ngocdo)");
						   $sender->sendMessage(TF::BLUE . "18 - Ngọc Màu Xanh (Tết) - 90000 xu (cú pháp: ngocxanh)");
						   $sender->sendMessage(TF::BLUE . "19 - Ngọc Màu Vàng (Tết) - 90000 xu (cú pháp: ngocvang)");
						   $sender->sendMessage(TF::BLUE . "20 - Ngọc In Dấu Gà (Tết) - 90000 xu (cú pháp: ngocga)");
						   $sender->sendMessage(TF::YELLOW . "Kho hàng chỉ mở bán Ngày Tết từ 21-1 đến 10-2");
						   return true;
						   break;
					   }
				   }
				return true;
				case "buy": //Co the edit them neu muon!
				   if(isset($args[1])){ //Trong khi edit cam xoa dong nay!!!!
					   switch (strtolower($args[1])){
						   //Iron Enchant Pickaxe
						  case "iron":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(257, 0, 1);
		                  $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 400000){
							  $sender->sendMessage(TF::RED . "Không đủ tiền");
						  }
						  else{
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 4000);
							  $item->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
							  $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(3));
							  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
					  $sender->getInventory()->addItem($item);
							  $sender->sendMessage(TF::YELLOW . "Bạn đã mua Iron Pickaxe Enchant với giá 4000 xu");
						  }
				          return true;
						  break;
						  //Diamond Enchant Pickaxe
						  case "dia":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(278, 0, 1);
						  $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 900000){
							  $sender->sendMessage(TF::RED . "Không đủ tiền");
						  }
						  else{
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 9000);
							  $item->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
							  $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(5));
							  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
							  $sender->getInventory()->addItem($item);
							  $sender->sendMessage(TF::YELLOW . "Bạn đã mua Diamond Pickaxe Enchant với giá 9000 xu");
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
							  $item->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
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
							  $item->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
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
						 $item1->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name2 = $item2->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $item2->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name3 = $item3->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $item3->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name4 = $item4->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $item4->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name5 = $item5->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $item5->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name6 = $item6->setCustomName("§9§lSet Thánh Gióng §6Legendary");
						 $item6->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
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
						 $item1->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name2 = $item2->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Áo Của Boss§b<•");
						 $item2->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name3 = $item3->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Quần Của Boss§b<•");
						 $item3->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name4 = $item4->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Giày Của Boss§b<•");
						 $item4->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name5 = $item5->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Kiếm Của Boss§b<•");
						 $item5->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $name6 = $item6->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Cúp Của Boss§b<•");
						 $item6->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
						 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						 if ($money < 6969696969696969){
							 $sender->sendMessage(TF::RED . "Không đủ tiền");
						 }
						 else{
					         $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 6969696969696969);
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
							 $sender->sendMessage(TF::YELLOW . "Bạn đã chính thức trở thành Boss Trong Server với $name1 trị giá 6969696969696969 xu");
						 }

						 return true;
						 break;
						 case "gaythongtri":
						  $p = $this->getServer()->getPlayer($sender->getName());
						  $item = Item::get(280, 0, 1);
						  $name = $item->setCustomName("§aGậy Thông Trĩ Siêu Cấp");
						  $item->setLore(array(TF::RED."§lHÀNG KHỦNG CHỈ BÁN TẠI §9SPECIAL SHOP!"));
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