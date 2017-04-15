<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class pickaxe extends Object {
	public function build() {
		$this->name = "pickaxe";
		$this->graphic = 0xE86;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 50;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 35;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 25;
		$this->oldmindamage = 1;
		$this->oldspeed = 35;
		$this->defhitsound = 0x232;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 60;
		$this->weight = 11.0;

}}
?>
