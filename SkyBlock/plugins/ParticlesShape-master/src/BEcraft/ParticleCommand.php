<?php

namespace BEcraft;

use BEcraft\Loader;
use pocketmine\{Server, Player};
use pocketmine\utils\TextFormat;
use pocketmine\command\{CommandSender, PluginCommand};

class ParticleCommand extends PluginCommand{
	
	private $plugin;
	
	public function __construct($command, Loader $plugin){
	parent::__construct($command, $plugin);
	$this->setDescription(TextFormat::YELLOW."Particles Shape Command");
	$this->plugin = $plugin;
	}
	
	public function getPlugin(){
	return $this->plugin;
	}
	
	public function execute(CommandSender $sender, $label, array $args){
	if(!$sender instanceof Player){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Run on game!");
	return;
	}
	
	if(!$sender->isOp()){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." You dont have permission");
	return;
	}
	
	$shapes = ["helix", "crown", "cloud", "dhelix", "laser"];
	
	if(!isset($args[0])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Use /particles <add [particle] [name]> | <remove [name]");
	return;
	}
	
	$values = ["add", "remove", "list"];
	
	if(!in_array($args[0], $values)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Use /particles <add [particle] [name]> | <remove [name], <list>");
	return;
	}
	
	switch($args[0]){
	case "add":
	if(!isset($args[1])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::GOLD." You need to specify any particle shape");
	return;
	}
	$shape = $args[1];
	if(!in_array($shape, $shapes)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." Uknown shape type, available shapes: ".TextFormat::GREEN.implode(", ", $shapes));
	return;
	}
	if(!isset($args[2])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::GOLD." You need to specify a name for this particle...");
	return;
	}
	$name = strtolower($args[2]);
	if(is_numeric($name)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." You need to use letters instance of numbers");
	return;
	}
	switch($shape){
	case "helix":
	$this->getPlugin()->newHelix($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "crown":
	$this->getPlugin()->newCrown($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "cloud":
	$this->getPlugin()->newCloud($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "dhelix":
	$this->getPlugin()->newDoubleHelix($sender->getLocation(), $sender->getLevel(), $name);
	break;
	case "laser":
	$this->getPlugin()->newLaser($sender, $name);
	break;
	}
	$sender->sendMessage(Loader::PREFIX.TextFormat::GRAY." You spawned a new particle called: ".TextFormat::GREEN.$name.TextFormat::GRAY.", shape: ".TextFormat::GREEN.$shape);
	return true;
	break;
	
	case "remove":
	if(!isset($args[1])){
	$sender->sendMessage(Loader::PREFIX.TextFormat::RED." You need to specify any name");
	return;
	}
	$name = strtolower($args[1]);
	if(!$this->getPlugin()->existsTask($name)){
	$sender->sendMessage(Loader::PREFIX.TextFormat::GRAY." There is not any particle with this name, use ".TextFormat::GREEN."/particles list".TextFormat::GRAY." to check all names");
	return;
	}
	$this->getPlugin()->removeTask($this->getPlugin()->tasks[$name]);
	unset($this->getPlugin()->tasks[$name]);
	$sender->sendMessage(Loader::PREFIX.TextFormat::GREEN." You removed particle named: ".TextFormat::GOLD.$name);
	return true;
	break;
	
	case "list":
	$sender->sendMessage($this->getPlugin()->getTasks());
	return true;
	break;
	}
	}
	
    }