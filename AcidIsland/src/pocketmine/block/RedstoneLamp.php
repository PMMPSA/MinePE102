<?php

/*
 *
 * 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author Mine102PE
 * @link https://github.com/Mine102PE/Mine102PE
 *
 *
*/

namespace pocketmine\block;

class RedstoneLamp extends Solid {
	protected $id = self::REDSTONE_LAMP;

	/**
	 * RedstoneLamp constructor.
	 *
	 * @param int $meta
	 */
	public function __construct($meta = 0){
		$this->meta = $meta;
	}

	/**
	 * @return int
	 */
	public function getLightLevel(){
		return 0;
	}

	/**
	 * @return string
	 */
	public function getName() : string{
		return "Redstone Lamp";
	}

	/**
	 * @return bool
	 */
	public function turnOn(){
		$this->getLevel()->setBlock($this, new LitRedstoneLamp(), true, true);
		return true;
	}
}
