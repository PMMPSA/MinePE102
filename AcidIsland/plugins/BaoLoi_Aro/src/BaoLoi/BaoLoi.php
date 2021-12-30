<?php

namespace BaoLoi;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as color;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\Config; 

class BaoLoi extends PluginBase Implements Listener{

  public $tag = "§9[§eBaoLoi§9] §f";

  public function onEnable(){
 $this->getServer()->getPluginManager()->registerEvents($this, $this);

if(!is_dir($this->getDataFolder())){ 
   @mkdir($this->getDataFolder()); 
} 
$this->config = new Config($this->getDataFolder()."config.yml",Config::YAML);
 $this->getLogger()->info("§c>§a==========BaoLoi==========§c<");
      }

  public function onDisable(){}

   public function onCommand(CommandSender $sender, Command $command, $label, array $args){
  if($sender instanceof Player){
        switch(strtolower($command->getName())){
           case "baoloi":
                    if(!isset($args[0])){
      $sender->sendMessage($this->tag."§6Xin hãy sử dụng /baoloi (Tên Của Bạn) [Lỗi]");
      $sender->sendMessage($this->tag."§aBạn ghi rõ lỗi hộ mình, cảm ơn bạn!"); 
              return true;
                }
  $pl = $sender->getServer()->getPlayer($args[0]);
 // if($pl instanceof Player){
    if(isset($args[1])){
  $motivo = implode(" ", $args);
								$worte = explode(" ", $motivo);
								unset($worte[0]);
								$motivo = implode(" ", $worte);
  $this->config->set($motivo);
  $this->config->save();
         $sender->sendMessage($this->tag."§6>§f Báo Lỗi thành công cảm ơn bạn");
     foreach($this->getServer()->getOnlinePlayers() as $p){
									if($p->isOp()){
										$p->sendMessage("§6>§c---------------§8[§eBaoLoi§r§8]§c---------------§6<\n§9Người gửi§8: §e".$args[0]."\n§9Lỗi§8: §e".$motivo."\n§6>§c---------------------------------------§6<");
                  }
            }
       } else {
   $sender->sendMessage($this->tag."§fSử dụng /baoloi <Tên> [Lỗi]");
         return true;
     }
   //} else {
   // $sender->sendMessage("§c".$args[0]." §ekhông trực tuyến");
   // return true;
                  // }
             }
       } else {
    $sender->sendMessage($this->tag."§cLệnh chỉ hoạt động trong trò chơi!");
      return true;       
      }
  }
}
    
    
    
      