<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BlackStaff extends Object {
	public function build() {
		$this->name = "black staff";
		$this->graphic = 0xDF0;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 35;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 16;
		$this->aosspeed = 39;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 35;
		$this->oldmindamage = 8;
		$this->oldspeed = 35;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 6.0;

}}
?>
