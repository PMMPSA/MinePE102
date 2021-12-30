<?php
namespace jasonwynn10\CrossOnlineCount;

use pocketmine\event\Listener;
use pocketmine\nbt\tag\StringTag;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

use slapper\events\SlapperCreationEvent;

use libpmquery\PMQuery;
use libpmquery\PmQueryException;

//use spoondetector\SpoonDetector;

class Main extends PluginBase implements Listener {

	public function onEnable() {
		//SpoonDetector::printSpoon($this, "spoon.txt");
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new UpdateTask($this), 5); // server updates query data every 5 ticks
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onDisable() {
		foreach($this->getServer()->getLevels() as $level) {
			foreach($level->getEntities() as $entity) {
				if(isset($entity->namedtag->server)) {
					$lines = explode("\n", $entity->getNameTag());
					$lines[0] = $entity->namedtag->server->getValue();
					$nametag = implode("\n", $lines);
					$entity->setNameTag($nametag);
				}
			}
		}
	}

	/**
	 * @priority LOW
	 *
	 * @param SlapperCreationEvent $ev
	 */
	public function onSlapperCreate(SlapperCreationEvent $ev) {
		$entity = $ev->getEntity();
		$lines = explode("\n", $entity->getNameTag());
		if($this->isValidIP($lines[0]) or $this->is_valid_domain_name($lines[0])) {
			$entity->namedtag->server = new StringTag("server", $lines[0]);
			$this->update();
		}else{
			$entity->namedtag->offsetUnset("server");
		}
	}

	/**
	 * @api
	 */
	public function update() {
		foreach($this->getServer()->getLevels() as $level) {
			foreach($level->getEntities() as $entity) {
				if(isset($entity->namedtag->server)) {
					$server = explode(":", $entity->namedtag->server->getValue());
					try {
						$queryData = PMQuery::query($server[0], $server[1]);
						$online = (int) $queryData['num'];

						$lines = explode("\n", $entity->getNameTag());
						$lines[0] = TextFormat::YELLOW.$online." Online".TextFormat::WHITE;
						$nametag = implode("\n", $lines);
						$entity->setNameTag($nametag);
					}catch(PmQueryException $e) {
						if($this->isPhar()) { // debug mode
							$this->getLogger()->logException($e);
						}else{
							$this->getLogger()->debug($e->getMessage());
						}

						$lines = explode("\n", $entity->getNameTag());
						$lines[0] = TextFormat::DARK_RED."Server Offline".TextFormat::WHITE;
						$nametag = implode("\n", $lines);
						$entity->setNameTag($nametag);
					}
				}
			}
		}
	}

	/**
	 * @api
	 *
	 * @param string $domain_name
	 *
	 * @return bool
	 */
	public function is_valid_domain_name(string $domain_name) {
		return (preg_match("/([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*:(\d{1,5})/i", $domain_name) != false) //valid chars check
		        and (preg_match("/.{1,253}/", $domain_name) != false) //overall length check
		        and (preg_match("/[^\.]{1,63}(\.[^\.]{1,63})*/", $domain_name) != false); //length of each label
	}

	/**
	 * @api
	 *
	 * @param string $ip
	 *
	 * @return bool
	 */
	public function isValidIP(string $ip) {
		return (preg_match("/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}):(\d{1,5})/", $ip) != false);
	}
}
