<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Object {
	/**
	 * Item variables
	 */
	public $serial;
	public $id;
	public $graphic;
	public $type;
	public $name;

	/**
	 * Item Position
	 */
	public $pos_x;
	public $pos_y;
	public $pos_z;
	
	public $hits;
	public $maxHits;
	
	public $direction;
	public $color;
	public $flags;
	public $value;
	public $amount;
	public $layer;

	/**
	 * Object create/destroy methods
	 */
	public function create() {}
	public function destroy() {}

	/**
	 * Object Buy/Sell methods
	 */
	public function buy() {}
	public function sell() {}

	/**
	 * Object Equip/Unequip methods
	 */
	public function equip() {}
	public function unequip() {}

	/**
	 * Object damage methods
	 */
	public function damage() {}
	public function spellEffect() {}

	/**
	 * Step on item method
	 */
	public function step() {}

	/**
	 * Timer events method
	 */
	public function timer() {}
	
	/**
	 * Object Click and DClick methods
	 */
	public function click() {}
	public function dclick() {}
	
	/**
	 * Object dropping methods
	 */
	public function dropOnChar() {}
	public function dropOnGround() {}
	public function dropOnItem() {}
	public function dropOnSeld() {}
	public function dropOnTrade() {}
	
	/**
	 * Object pickingup methods
	 */
	public function pickupGround() {}
	public function pickupPack() {}
	public function pickupSelf() {}
	public function pickupStack() {}
	
	/**
	 * Object targeting methods
	 */
	public function targOnCancel() {}
	public function targOnChar() {}
	public function targOnGround() {}
	public function targOnItem() {}
}