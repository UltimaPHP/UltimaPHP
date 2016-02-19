<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class i_sword_viking extends Object {

	public function __construct() {
		$this->name = "Viking Sword%s";
		$this->graphic = 0x13b9;
		$this->type = "type_weapon";
		$this->flags = 0x0;
		$this->value = 100;
		$this->amount = 1;
		$this->color = 0x0;
		$this->serial = "4004BC9D"; //str_pad(102500 + rand(1111,9999), 8, "0", STR_PAD_LEFT);
	}
}