<?php

/*
 *
 * ______ _____ _   __      _   ___           ______ _ *   
 * | ___ \_   _| | / /     | | / (_)          | ___ \ | *  
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
 * \_|  |_/_|_| |_|\___\___/\___/ \_____/\_|   \____/ *  
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

use pocketmine\permission\ServerOperator;

interface IPlayer extends ServerOperator {

	/**
	 * @return bool
	 */
	public function isOnline();

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @return bool
	 */
	public function isBanned();

	/**
	 * @param bool $banned
	 */
	public function setBanned($banned);

	/**
	 * @return bool
	 */
	public function isWhitelisted();

	/**
	 * @param bool $value
	 */
	public function setWhitelisted($value);

	/**
	 * @return Player|null
	 */
	public function getPlayer();

	/**
	 * @return int|double
	 */
	public function getFirstPlayed();

	/**
	 * @return int|double
	 */
	public function getLastPlayed();

	/**
	 * @return mixed
	 */
	public function hasPlayedBefore();

}
