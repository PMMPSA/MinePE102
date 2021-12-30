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
 * Chương trình này là phần mềm miễn phí: bạn có thể phân phối lại nó và / hoặc sửa đổi
 * theo điều khoản của Giấy phép Công cộng nhỏ hơn GNU như được xuất bản bởi
 * Free Software Foundation, phiên bản 3 của Giấy phép, hoặc  * (Tùy chọn) bất kỳ phiên bản sau nào.
 *
 * @author Mine102PE
 * @link https://fb.com/Mine102PEDev
 *
 *
*/

namespace pocketmine;

/**
 * This class must be extended by all custom threading classes
 */
abstract class Worker extends \Worker {

	/** @var \ClassLoader */
	protected $classLoader;

	protected $isKilled = false;

	/**
	 * @return \ClassLoader
	 */
	public function getClassLoader(){
		return $this->classLoader;
	}

	/**
	 * @param \ClassLoader|null $loader
	 */
	public function setClassLoader(\ClassLoader $loader = null){
		if($loader === null){
			$loader = Server::getInstance()->getLoader();
		}
		$this->classLoader = $loader;
	}

	public function registerClassLoader(){
		if(!interface_exists("ClassLoader", false)){
			require(\pocketmine\PATH . "src/spl/ClassLoader.php");
			require(\pocketmine\PATH . "src/spl/BaseClassLoader.php");
		}
		if($this->classLoader !== null){
			$this->classLoader->register(true);
		}
	}

	/**
	 * @param int $options
	 *
	 * @return bool
	 */
	public function start(int $options = PTHREADS_INHERIT_ALL){
		ThreadManager::getInstance()->add($this);

		if(!$this->isRunning() and !$this->isJoined() and !$this->isTerminated()){
			if($this->getClassLoader() === null){
				$this->setClassLoader();
			}
			return parent::start($options);
		}

		return false;
	}

	/**
	 * Stops the thread using the best way possible. Try to stop it yourself before calling this.
	 */
	public function quit(){
		$this->isKilled = true;

		$this->notify();

		if($this->isRunning()){
			$this->shutdown();
			$this->notify();
			$this->unstack();
		}elseif(!$this->isJoined()){
			if(!$this->isTerminated()){
				$this->join();
			}
		}

		ThreadManager::getInstance()->remove($this);
	}

	/**
	 * @return string
	 */
	public function getThreadName(){
		return (new \ReflectionClass($this))->getShortName();
	}
}
