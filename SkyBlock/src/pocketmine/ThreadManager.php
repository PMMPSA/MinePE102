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

class ThreadManager extends \Volatile {

	/** @var ThreadManager */
	private static $instance = null;

	public static function init(){
		self::$instance = new ThreadManager();
	}

	/**
	 * @return ThreadManager
	 */
	public static function getInstance(){
		return self::$instance;
	}

	/**
	 * @param Worker|Thread $thread
	 */
	public function add($thread){
		if($thread instanceof Thread or $thread instanceof Worker){
			$this->{spl_object_hash($thread)} = $thread;
		}
	}

	/**
	 * @param Worker|Thread $thread
	 */
	public function remove($thread){
		if($thread instanceof Thread or $thread instanceof Worker){
			unset($this->{spl_object_hash($thread)});
		}
	}

	/**
	 * @return Worker[]|Thread[]
	 */
	public function getAll(){
		$array = [];
		foreach($this as $key => $thread){
			$array[$key] = $thread;
		}

		return $array;
	}
}