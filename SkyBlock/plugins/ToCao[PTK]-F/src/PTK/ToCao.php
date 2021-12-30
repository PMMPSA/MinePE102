<?php

namespace PTK;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;

class ToCao extends PluginBase implements Listener {
	
	public $prefix = "§7[§aTố Cáo§7] §f";
	public $tocao = array();
	
	public function onEnable(){
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder()."Tất Cả Những Tố Cáo");
		
		$this->getLogger()->info($this->prefix."§aPlugin đã chạy");
		
		$this->tocao = array();
		
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new ToCaoBlock($this), 20);
	}
	public function onJoin(PlayerJoinEvent $event){
		$this->tocao[$event->getPlayer()->getName()] = 0;
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		
		if(strtolower($cmd->getName()) == "tocao"){
			if(isset($args[0])){
				
				if((strtolower($args[0]) == "list") && ($sender->isOP() || $p->hasPermission("tocao.manage"))){
					
					$sender->sendMessage($this->prefix." §7[§aID-List§7]");
					
					$files = scandir($this->getDataFolder()."Tất Cả Những Tố Cáo");
					
					foreach($files as $tocao){
						$tocao = str_replace(".yml", "", $tocao);
						if($tocao != "." && $tocao != ".."){
							$sender->sendMessage("§7- §f".$tocao);
						}
					}
					$sender->sendMessage(" ");
					$sender->sendMessage($this->prefix."để đọc tố cáo hãy sử dụng -> /tocao read");
				}
				elseif((strtolower($args[0]) == "delete") && ($sender->isOP() || $p->hasPermission("tocao.manage"))){
					if(isset($args[1])){
						$tocaoID = (int) $args[1];
						if($tocaoID != 0){
							
							if(file_exists($this->getDataFolder()."Tất Cả Những Tố Cáo/".$tocaoID.".yml")){
								
								unlink($this->getDataFolder()."Tất Cả Những Tố Cáo/".$tocaoID.".yml");
								
								$sender->sendMessage($this->prefix."ToCaoe con el ID §6".$tocaoID." §feliminado!");
								
							} else {
								$sender->sendMessage($this->prefix."el tocaoe con el ID: ".$tocaoID." , no existe usa ! ->/tocao list");
							}
							
						} else {
							$sender->sendMessage($this->prefix.$tocaoID." no es un ID");
						}
						
					} else {
						$sender->sendMessage($this->prefix."/tocao delete <ID tố cáo>");
					}
				}
				elseif((strtolower($args[0]) == "read") && ($sender->isOP() || $p->hasPermission("tocao.manage"))){
					if(isset($args[1])){
						$tocaoID = (int) $args[1];
						
						if($tocaoID != 0){
						
							if(file_exists($this->getDataFolder()."Tất Cả Những Tố Cáo/".$tocaoID.".yml")){
								
								$tocao = new Config($this->getDataFolder()."Tất Cả Những Tố Cáo/".$tocaoID.".yml", Config::YAML);
								
								$nguoitocao = $tocao->get("Playertocao");
								$nguoibitocao = $tocao->get("Playerbitocao");
								$lido = $tocao->get("Lidobitocao");
								
								$sender->sendMessage("§7====================");
								$sender->sendMessage("Người tố cáo: §a".$nguoitocao);
								$sender->sendMessage("Người bị tố cáo: §c".$nguoibitocao);
								$sender->sendMessage("Lí do: §b".$lido);
								$sender->sendMessage("§7====================");
								
							} else {
								$sender->sendMessage($this->prefix."ID tố cáo: ".$tocaoID." , không tồn tại !Hãy dùng ->/tocao list");
							}
						} else {
							$sender->sendMessage($this->prefix.$tocaoID." không phải là ID");
						}
					} else {
						$sender->sendMessage($this->prefix."/tocao read <ID tố cáo>");
					}
				} else {
					if(isset($args[1])){
						if(file_exists($this->getServer()->getDataPath()."players/".strtolower($args[0]).".dat")){
						$player = $args[0];
						
						$tocaoID = 1;
						$files = scandir($this->getDataFolder()."Tất Cả Những Tố Cáo");
							foreach($files as $filename){
								if($filename != "." && $filename != ".."){
								$tocao = (int) str_replace("ToCao", "", $filename);
								$tocao = (int) str_replace(".yml", "", $tocao);
								
								if($tocao >= $tocaoID){
									$tocao++;
									$tocaoID = $tocao;
								}
								}
							}
						
						if(file_exists($this->getDataFolder()."Tất Cả Những Tố Cáo/".$tocaoID.".yml")){
							$sender->sendMessage($this->prefix."§cEste ID ya esta en uso");
						} else {
							if($this->tocao[$sender->getName()] <= 0){
								$newToCao = new Config($this->getDataFolder()."Tất Cả Những Tố Cáo/".$tocaoID.".yml", Config::YAML);
								
								$lido = implode(" ", $args);
								$worte = explode(" ", $lido);
								unset($worte[0]);
								$lido = implode(" ", $worte);
								
								
								$newToCao->set("Playertocao", strtolower($sender->getName()));
								$newToCao->set("Playerbitocao", strtolower($args[0]));
								$newToCao->set("Lidobitocao", $lido);
								$newToCao->save();
								
								$this->tocao[$sender->getName()] = 600;
								$sender->sendMessage($this->prefix."§aToCaoe de §6".strtolower($args[0])." §aenviado con exito!");
								
								foreach($this->getServer()->getOnlinePlayers() as $p){
									if($p->isOP()){
										$p->sendMessage($this->prefix."§6".strtolower($sender->getName())." §aha presentado un nuevo informe!");
									}
								}
								$this->getLogger()->info($this->prefix."§6".strtolower($sender->getName())." §aha presentado un nuevo informe!");
							} else {
								if($this->tocao[$sender->getName()] <= 60){
									$rest = $this->tocao[$sender->getName()];
									$sender->sendMessage($this->prefix."§cUsted puede solamente en ".$rest." Segundos para enviar otro tocaoe!");
								} else {
									$rest = round($this->tocao[$sender->getName()] /60);
									$sender->sendMessage($this->prefix."§cUsted puede solamente en ".$rest." Minutos para enviar otro tocaoe!");
								}
							}
						}
					} else {
						$sender->sendMessage($this->prefix."§c Cách sử dụng!");
					}
					} else {
						$sender->sendMessage($this->prefix."/tocao <người chơi> <lí do>");
					}
					
				}
			} else {
				$sender->sendMessage($this->prefix."/tocao <Player | Read | List | Delete>");
			}
		}
		
	}
	
}
class ToCaoBlock extends PluginTask {
	
	public function __construct($plugin) {
		$this->plugin = $plugin;
		parent::__construct($plugin);
	}
	
	public function onRun($tick) {
		
		foreach($this->plugin->getServer()->getOnlinePlayers() as $nguoitocao){
			$name = $nguoitocao->getName();
			
			if(!isset($this->plugin->tocao[$name])){
				$this->plugin->tocao[$name] = 0;
			}
			
			$tocaoTimer = $this->plugin->tocao[$name];
			if($tocaoTimer > 0){
				$tocaoTimer--;
				$this->plugin->tocao[$name] = $tocaoTimer;
			}
		}
	}
}