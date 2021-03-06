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

use pocketmine\item\Item;
use pocketmine\item\Tool;


class LitRedstoneLamp extends Solid {
	protected $id = self::LIT_REDSTONE_LAMP;

	/**
	 * LitRedstoneLamp constructor.
	 *
	 * @param int $meta
	 */
	public function __construct($meta = 0){
		$this->meta = $meta;
	}

	/**
	 * @return string
	 */
	public function getName() : string{
		return "Lit Redstone Lamp";
	}

	/**
	 * @return float
	 */
	public function getHardness(){
		return 0.3;
	}

	/**
	 * @return int
	 */
	public function getToolType(){
		return Tool::TYPE_PICKAXE;
	}


	/**
	 * @param Item $item
	 *
	 * @return array
	 */
	public function getDrops(Item $item) : array{
		return [
			[Item::REDSTONE_LAMP, 0, 1],
		];
	}

	/**
	 * @return bool
	 */
	public function turnOn(){
		$this->meta = 0;
		$this->getLevel()->setBlock($this, $this, true, false);
		return true;
	}

	/**
	 * @return bool
	 */
	public function turnOff(){
		$this->getLevel()->setBlock($this, new RedstoneLamp(), true, true);
		return true;
	}
}