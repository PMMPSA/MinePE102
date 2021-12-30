<?php

/*
 *
 * ______ _____ _   __      _   ___           ______ _  
 * | ___ \_   _| | / /     | | / (_)          | ___ \ | 
 * | |_/ / | | | |/ /______| |/ / _  ___ _ __ | |_/ / |__   __ _ _ __ ___  
 * |  __/  | | |    \______|    \| |/ _ \ '_ \|  __/| '_ \ / _` | '_ ` _ \ 
 * | |     | | | |\  \     | |\  \ |  __/ | | | |   | | | | (_| | | | | | |
 * \_|     \_/ \_| \_/     \_| \_/_|\___|_| |_\_|   |_| |_|\__,_|_| |_| |_|
 *
 * ___  ____            __  _____  _____ ______ _____ 
 * |  \/  (_)          /  ||  _  |/ __  \| ___ \  ___|
 * | .  . |_ _ __   ___`| || |/' |`' / /'| |_/ / |__  
 * | |\/| | | '_ \ / _ \| ||  /| |  / /  |  __/|  __| 
 * | |  | | | | | |  __/| |\ |_/ /./ /___| |   | |___ 
 * \_|  |_/_|_| |_|\___\___/\___/ \_____/\_|   \____/ 
 *
 *Plugin được viết bởi PTK-KienPham
*/

namespace PlayerVaults;

use PlayerVaults\Vault\Vault;

use pocketmine\command\{Command, CommandSender};
use pocketmine\level\Level;
use pocketmine\plugin\PluginBase;
use pocketmine\tile\Tile;
use pocketmine\utils\TextFormat as TF;

class PlayerVaults extends PluginBase{

    private $data = null;
    private $mysqldata = [];
    private static $instance = null;
    private $parsedConfig = [];

    public function onEnable(){
        self::$instance = $this;
        $this->getLogger()->notice(implode(TF::RESET.PHP_EOL.TF::YELLOW, [
            'Đã tải plugin PlayerVault bởi PTK-KienPham',
            '   ___ _                                        _ _       ',
            '  / _ \ | __ _ _   _  ___ _ __/\   /\__ _ _   _| | |_ ___ ',
            ' / /_)/ |/ _" | | | |/ _ \ "__\ \ / / _" | | | | | __/ __|',
            '/ ___/| | (_| | |_| |  __/ |   \ V / (_| | |_| | | |_\__ \ ',
            '\/    |_|\__,_|\__, |\___|_|    \_/ \__,_|\__,_|_|\__|___/',
            '               |___/                                      ',
            ' ',
            'GitHub: http://fb.com/Mine102PEDev'
        ]));

        if(!is_dir($this->getDataFolder())){
            mkdir($this->getDataFolder());
        }
        if(!is_dir($this->getDataFolder()."vaults")){
            mkdir($this->getDataFolder()."vaults");
        }
        if(!file_exists($this->getDataFolder()."config.yml")){
            $this->saveDefaultConfig();
        }

        $this->updateConfig();
        $this->registerConfig();

        $type = $this->getConfig()->get("provider", "json");
        $type = Provider::TYPE_FROM_STRING[strtolower($type)] ?? Provider::UNKNOWN;
        $this->mysqldata = array_values($this->getConfig()->get("mysql", []));
        $this->maxvaults = $this->getConfig()->get("max-vaults", 25);
        if($type === Provider::MYSQL){
            $mysql = new \mysqli(...$this->mysqldata);
            $db = $this->mysqldata[3];
            $mysql->query("CREATE TABLE IF NOT EXISTS vaults(player VARCHAR(16), inventory TEXT, number TINYINT)");
            $mysql->close();
        }
        $this->data = new Provider($type);

        Tile::registerTile(Vault::class);
    }

    private function updateConfig(){
        $config = $this->getConfig();
        foreach(yaml_parse(stream_get_contents($this->getResource("config.yml"))) as $key => $value){
            if($config->get($key) === false){
                $config->set($key, $value);
            }
        }
        $config->save();
    }

    private function registerConfig(){
        $this->parsedConfig = yaml_parse_file($this->getDataFolder()."config.yml");
    }

    public function getFromConfig($key){
        return $this->parsedConfig[$key] ?? null;
    }

    public function getData() : Provider{
        return $this->data;
    }

    public function getMysqlData() : array{
        return $this->mysqldata;
    }

    public function getMaxVaults() : int{
        return $this->maxvaults;
    }

    public static function getInstance() : self{
        return self::$instance;
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        if(isset($args[0]) && $args[0] !== "help" && $args[0] !== ""){
            if(is_numeric($args[0])){
                if(strpos($args[0], ".") !== false){
                    $sender->sendMessage(TF::RED."Please insert a valid number.");
                }elseif($args[0] < 1 || $args[0] > $this->getMaxVaults()){
                    $sender->sendMessage(TF::YELLOW."Xin hãy sử dụng lệnh: ".TF::GOLD."/pv <1-".$this->getMaxVaults().">");
                }else{
                    if($sender->y + Provider::INVENTORY_HEIGHT > Level::Y_MAX){
                        $sender->sendMessage(TF::RED."Cannot open vault at this height. Please lower down to at least Y=".Level::Y_MAX - Provider::INVENTORY_HEIGHT);
                    }else{
                        if($sender->hasPermission("playervaults.vault.".$args[0])){
                            $sender->sendMessage(TF::YELLOW."Đang mở §fkét sắt §esố ".TF::AQUA."".$args[0]."...");
                            $this->getData()->sendContents($sender, $args[0]);
                        }else{
                            $sender->sendMessage(TF::RED."You don't have permission to access vault #".$args[0]);
                        }
                    }
                }
            }else{
                if($sender->isOp()){
                    switch(strtolower($args[0])){
                        case "of":
                            if(!isset($args[1])){
                                $sender->sendMessage(TF::RED."Xin hãy sử dụng: /$cmd of <tên player> <số két sắt>");
                            }else{
                                if(($player = $this->getServer()->getPlayer($args[1])) !== null){
                                    $args[1] = $player->getLowerCaseName();
                                    $player = $player->getName();
                                }
                                $args[2] = $args[2] ?? 1;
                                if(!is_numeric($args[2])){
                                    $sender->sendMessage(TF::RED."Xin hãy sử dụng: /$cmd of <tên player> <1-".$this->getMaxVaults().">");
                                    break;
                                }
                                $this->getData()->sendContents($args[1], $args[2] ?? 1, $sender->getName());
                                $sender->sendMessage(TF::YELLOW."Đang mở §fkét sắt §esố ".TF::AQUA."".($args[2] ?? 1)." cho ".($player ?? $args[1])."...");
                            }
                            break;
                        case "empty":
                            if(!isset($args[1])){
                                $sender->sendMessage(TF::RED."Xin hãy sử dụng: /$cmd empty <tên player> <số két sắt|all>");
                            }else{
                                if(($player = $this->getServer()->getPlayerExact($args[1])) !== null){
                                    $args[1] = $player->getLowerCaseName();
                                    $player = $player->getName();
                                }
                                if(!isset($args[2]) || ($args[2] != "all" && !is_numeric($args[2]))){
                                    $sender->sendMessage(TF::RED."Xin hãy sử dụng: /$cmd empty <tên plauer> <số két sắt|all>");
                                }else{
                                    if((is_numeric($args[2]) && ($args[2] >= 1 || $args[2] <= $this->getMaxVaults())) || $args[2] == "all"){
                                        $this->getData()->deleteVault(strtolower($player ?? $args[1]), $args[2] == "all" ? -1 : $args[2]);
                                        if($args[2] == "all"){
                                            $sender->sendMessage(TF::YELLOW."Đã xóa tất cả đồ trong tất cả két sắt của ".($player ?? $args[1]).".");
                                        }else{
                                            $sender->sendMessage(TF::YELLOW."Đã xóa két sắt số ".$args[2]." của ".($player ?? $args[1]).".");
                                        }
                                    }else{
                                        $sender->sendMessage(TF::RED."Usage: /$cmd empty ".$args[1]." <1-".$this->getMaxVaults().">");
                                    }
                                }
                            }
                            break;
                    }
                }
                switch(strtolower($args[0])){
                    case "admin":
                        $sender->sendMessage(implode(TF::RESET.PHP_EOL, [
                            TF::GREEN."/$cmd of <player> <number=1> - ".TF::YELLOW."Show <player>'s vault contents.",
                            TF::GREEN."/$cmd empty <player> <number|all> - ".TF::YELLOW."Empty <player>'s vault #number or all their vaults."
                        ]));
                        break;
                }
            }
        }else{
            $sender->sendMessage(implode(TF::RESET.PHP_EOL, [
                TF::GREEN."/$cmd <số> - ".TF::YELLOW."Mở Két Sắt."
            ]));
            if($sender->isOp()){
                $sender->sendMessage(TF::RED."Use '/$cmd admin' for a list of admin commands.");
            }
        }
    }
}
