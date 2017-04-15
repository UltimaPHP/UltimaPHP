<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class broadsword extends Object {
	public function build() {
		$this->name = "broadsword";
		$this->graphic = 0xF5E;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 30;
		$this->aosmindamage = 14;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 33;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 25;
		$this->oldmindamage = 5;
		$this->oldspeed = 45;
		$this->defhitsound = 0x237;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 100;
		$this->weight = 6.0;

}}
?>
